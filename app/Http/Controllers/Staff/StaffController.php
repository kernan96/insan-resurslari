<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Structure\OrgDepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\Structure\OrganizationType;
use App\Models\Structure\OrganizationDepartment;
use App\Models\Structure\OrgPosition;
use App\Models\Structure\EmploymentType;
use App\Models\Structure\UserEmployment;
use App\Models\Structure\OldUserEmployment;
use App\Models\Structure\UserAward;
use App\Models\Structure\AwardType;
use App\Models\Structure\UserPartyMembership;
use App\Models\Structure\Position;
use App\Models\Structure\User;
use App\Models\Structure\Role;
use App\Models\Structure\Military;
use App\Models\Structure\MilitaryType;
use App\Models\Structure\NameChange;
use App\Models\Structure\Phone;
use App\Models\Structure\PhoneType;
use App\Models\Structure\RelationshipType;
use App\Models\Structure\UserRelative;
use App\Models\Structure\CriminalRecord;
use App\Models\Staff\DocumentType;
use App\Models\Staff\Document;

use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;


class StaffController extends Controller
{
    public function personnelDocuments()
    {
        $qurumId = 1;
        // əsas qurum
        $root = OrganizationDepartment::find($qurumId);
        // bütün alt departamentlər
        $children = $this->getAllChildDepartments($qurumId);
        // filter (organization_type_id > 2)
        $filteredDepartments = $children->where('organization_type_id', '>', 2);
        // özünü də əlavə et
        $allDepartments = $children->push($root);
        // id-ləri götür
        $departmentIds = $allDepartments->pluck('id');
        $users = User::with(['activeEmployment'])
            ->whereHas('orgPosition.organizationDepartment', function ($q) use ($departmentIds) {
                $q->whereIn('id', $departmentIds)
                    ->where('is_active', true);
            })
            ->whereHas('activeEmployment')
            ->get();
        $documentTypes0 = DocumentType::where('is_multiple', 0)->get();
        $documentTypes1 = DocumentType::where('is_multiple', 1)->get();
        // Parent_id = null olanları (Qurumları) getir
        $organizations = OrganizationDepartment::whereNull('parent_id')
            ->where('is_active', 1)
            ->get();
        return view('pages.staff.personnel-documents', compact('organizations', 'documentTypes0', 'documentTypes1', 'users'));
    }
    public function personnelDocumentStore(StoreDocumentRequest $request)
    {
        $documentTypes = DocumentType::all();
        $results = [];
        foreach ($documentTypes as $docType) {
            $files = $request->file($docType->input_name);
            if (!$files) continue;
            // əgər single-dirsə array-ə çevir
            if (!$docType->is_multiple) {
                $files = [$files];
            }
            if ($files) {
                foreach ($files as $file) {
                    if (!$file) continue;
                    // Fayl adını unikal etmək
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs("uploads/{$request->user_id}", $filename, 'public');
                    // DB-yə yaz
                    $document = Document::create([
                        'user_id' => $request->user_id,
                        'document_type_id' => $docType->id,
                        'title' => $filename,
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize(),
                        'is_active' => 1,
                    ]);
                    $results[] = [
                        'status' => 'success',
                        'doc_id' => $document->id, // 🔥 BURADA ID-NI GÖNDƏR
                        'file_path' => asset('storage/' . $document->file_path), // 🔥 BURADA ID-NI GÖNDƏR
                        'original_name' => $file->getClientOriginalName()
                    ];
                }
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Fayllar uğurla yükləndi',
            'uploadResults' => $results
        ]);
    }
    // Secili quruma bagli Şöbeleri getir (organization_type_id = "Şöbə" olanlar)
    public function getDepartmentsByOrganization(Request $request)
    {
        $organizationId = $request->organization_id;
        $departments = OrganizationDepartment::where('parent_id', $organizationId)
            ->whereHas('organizationType', function ($query) {
                $query->where('name', 'Şöbə');
            })
            ->where('is_active', 1)
            ->get();
        return response()->json($departments);
    }
    // Secili quruma bagli Sektorleri getir (organization_type_id = "Sektor" olanlar)
    public function getSectorsByOrganization(Request $request)
    {
        $organizationId = $request->organization_id;
        $sectors = OrganizationDepartment::where('parent_id', $organizationId)
            ->whereHas('organizationType', function ($query) {
                $query->where('name', 'Sektor');
            })
            ->where('is_active', 1)
            ->get();
        return response()->json($sectors);
    }
    // Secili Şöbeye bagli Sektorleri getir (Şöbənin altında olan Sektorlar)
    public function getSectorsByDepartment(Request $request)
    {
        $departmentId = $request->department_id;
        $sectors = OrganizationDepartment::where('parent_id', $departmentId)
            ->whereHas('organizationType', function ($query) {
                $query->where('name', 'Sektor');
            })
            ->where('is_active', 1)
            ->get();
        return response()->json($sectors);
    }
    // Secili quruma bagli istifadecileri getir
    public function getUsersByOrganization(Request $request)
    {
        $organizationId = $request->organization_id;
        $users = User::whereHas('orgPosition', function ($query) use ($organizationId) {
            $query->where('org_dep_id', $organizationId);
        })->with('orgPosition.position')->get();
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'full_name' => $user->first_name . ' ' . ($user->father_name ?? '') . ' ' . $user->last_name,
                'position_id' => $user->orgPosition->position_id ?? null,
                'position_name' => $user->orgPosition->position->name ?? null
            ];
        });
        return response()->json($formattedUsers);
    }
    // Secili şöbeye bagli istifadecileri getir
    public function getUsersByDepartment(Request $request)
    {
        $departmentId = $request->department_id;
        $users = User::whereHas('orgPosition', function ($query) use ($departmentId) {
            $query->where('org_dep_id', $departmentId);
        })->with('orgPosition.position')->get();
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'full_name' => $user->first_name . ' ' . ($user->father_name ?? '') . ' ' . $user->last_name,
                'position_id' => $user->orgPosition->position_id ?? null,
                'position_name' => $user->orgPosition->position->name ?? null
            ];
        });
        return response()->json($formattedUsers);
    }
    // Secili sektora bagli istifadecileri getir
    public function getUsersBySector(Request $request)
    {
        $sectorId = $request->sector_id;
        $users = User::whereHas('orgPosition', function ($query) use ($sectorId) {
            $query->where('org_dep_id', $sectorId);
        })->with('orgPosition.position')->get();
        $formattedUsers = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'full_name' => $user->first_name . ' ' . ($user->father_name ?? '') . ' ' . $user->last_name,
                'position_id' => $user->orgPosition->position_id ?? null,
                'position_name' => $user->orgPosition->position->name ?? null
            ];
        });
        return response()->json($formattedUsers);
    }
    // Secili istifadecinin vəzifəsini getir
    public function getPositionByUser(Request $request)
    {
        $userId = $request->user_id;
        $user = User::with('orgPosition.position')->find($userId);
        if ($user && $user->orgPosition && $user->orgPosition->position) {
            return response()->json([
                'position_id' => $user->orgPosition->position_id,
                'position_name' => $user->orgPosition->position->name
            ]);
        }
        return response()->json(null);
    }
    private function getAllChildDepartments($parentId)
    {
        $departments = OrganizationDepartment::where('parent_id', $parentId)->get();
        $all = collect();
        foreach ($departments as $dep) {
            $all->push($dep);
            $children = $this->getAllChildDepartments($dep->id);
            $all = $all->merge($children);
        }
        return $all;
    }
    // UserController.php
    public function getUserDocData($id)
    {
        $user = User::with([
            'activeEmployment.employmentType',
            'documents.documentType',
            'orgPosition.position',
            'orgPosition.organizationDepartment.organizationType'
        ])->findOrFail($id);
        // Hər bir sənəd üçün tam URL əlavə et
        $user->documents->map(function ($document) {
            $document->file_path = asset('storage/' . $document->file_path);
            return $document;
        });
        return response()->json($user);
    }
    public function destroyDocument($id)
    {
        $doc = Document::find($id);
        if (!$doc) {
            return response()->json(['success' => false, 'message' => 'Sənəd tapılmadı']);
        }
        // Faylı storage-dan sil ('public' diskindən)
        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }
        // DB-dən sil
        $doc->delete();
        return response()->json(['success' => true, 'message' => 'Sənəd silindi']);
    }
    public function exportWordForma3($id)
    {
        function fmtDate($date)
        {
            return $date ? \Carbon\Carbon::parse($date)->format('d.m.Y') : '';
        }
        $template = new TemplateProcessor(storage_path('app/templates/forma_3_temp.docx'));
        $user = User::with([
            'orgPosition.organizationDepartment',
        ])->findOrFail($id);
        // 🔹 FULL NAME
        $fullName = $user->first_name . ' ' . $user->last_name . ' ' . $user->father_name;
        $fullName .= ($user->gender == 0 || $user->gender === false) ? ' oğlu' : ' qızı';
        $template->setValue('full_name', $fullName);
        // 🔹 DEPARTMENT
        $topDepartment = app(OrgDepartmentController::class)
            ->findTopOrganizationDepartment(optional($user->orgPosition)->id);
        $department = optional($topDepartment)->name;
        $template->setValue('department', $department);
        // 🔹 DEPARTMENT date
        $userEmployment = UserEmployment::where('user_id', $user->id)
            ->where('organization_id', optional($topDepartment)->id)
            ->orderBy('start_date', 'asc')
            ->first();
        $startDateDepartment = $userEmployment ? $userEmployment->start_date : '';
        $template->setValue('start_date_department', fmtDate($startDateDepartment));
        // 🔹 BIRTH + ADDRESS
        $birthDate = $user->birth_date ? fmtDate($user->birth_date) : '';
        $birthAddress = $user->birth_place;
        $template->setValue(
            'birth_address',
            $birthDate . ', ' . $birthAddress
        );
        // 🔹 ŞƏKİL (Table 1)
        $path = storage_path('app/public/' . $user->profile_photo_path);
        if ($user->profile_photo_path) {
            $template->setImageValue('photo', [
                'path' => $path,
                'width' => '3cm',
                'height' => '4cm',
            ]);
        }

        // 🔹 MILITARY RANKS (hərbi rütbələr)
        $ranks = $user->militaries->pluck('rank')->filter()->implode(', ');

        if ($ranks) {
            $ranks = "{Dövlət qulluğunun ixtisas dərəcəsi}, " . $ranks;
        } else {
            $ranks = "{Dövlət qulluğunun ixtisas dərəcəsi}";
        }
        $template->setValue('ranks', $ranks ?: '');


        // 🔹 EDUCATION LEVEL (təhsil səviyyəsi)
        $educationTypeIds = $user->educations->pluck('education_type_id')->unique()->toArray();
        $edu_level = '';
        if (in_array(2, $educationTypeIds) || in_array(3, $educationTypeIds)) {
            $edu_level = 'Ali';
        } elseif (in_array(1, $educationTypeIds)) {
            $edu_level = 'Orta';
        }
        $template->setValue('edu_level', $edu_level);

        // 🔹 EDUCATION ORG AND DATE (təhsil müəssisəsi və tarixi)
        $educations = $user->educations->load('educationType');
        $edu_org_and_date = '';
        $major = '';

        if ($edu_level == 'Orta') {
            // Filter: yalnız education_type_id = 1 olanlar
            $filtered = $educations->where('education_type_id', 1);
            $items = [];
            foreach ($filtered as $edu) {
                $items[] = $edu->org_name . " (Orta), " . fmtDate($edu->end_date);
            }
            $edu_org_and_date = implode(', ', $items);
        } elseif ($edu_level == 'Ali') {
            // Filter: education_type_id = 2,3,4,5 olanlar
            $filtered = $educations->whereIn('education_type_id', [2, 3, 4, 5])
                ->sortBy('education_type_id');

            $items = [];
            $majors = [];
            foreach ($filtered as $edu) {
                $typeName = optional($edu->educationType)->name ?: '';
                $items[] = $edu->org_name . " (" . $typeName . "), " . fmtDate($edu->end_date);
                if ($edu->major) {
                    $majors[] = $edu->major;
                }
            }
            $edu_org_and_date = implode(', ', $items);

            // Remove duplicates from majors
            $majors = array_unique($majors);
            $major = implode(', ', $majors);
        }
        $template->setValue('edu_org_and_date', $edu_org_and_date);
        $template->setValue('major', $major);

        // 🔹 ACADEMIC DEGREE (elmi dərəcə)
        $academicDegrees = $user->academicDegrees->load('academicType')
            ->pluck('academicType.name')
            ->filter()
            ->implode(', ');
        $template->setValue('academic_degree', $academicDegrees);

        // 🔹 LANGUAGES (dillər)
        $userLanguages = $user->userLanguages->load(['language', 'languageLevel']);
        $languages = [];
        foreach ($userLanguages as $ul) {
            $langName = optional($ul->language)->name ?: '';
            $levelName = optional($ul->languageLevel)->name ?: '';
            if ($langName) {
                $languages[] = $langName . " (" . $levelName . ")";
            }
        }
        $template->setValue('language', implode(', ', $languages));



        // 1. Yeni employment-lar
        $userEmployments = UserEmployment::with(['position', 'organization'])
            ->where('user_id', $user->id)
            ->get()
            ->map(function ($emp) {
                return [
                    'start_date' => $emp->start_date,
                    'end_date' => $emp->end_date,
                    'position' => optional($emp->position)->name,
                    'organization' => optional($emp->organization)->name,
                ];
            });

        // 2. Köhnə employment-lar
        $oldEmployments = OldUserEmployment::where('user_id', $user->id)
            ->get()
            ->map(function ($emp) {
                return [
                    'start_date' => $emp->start_date,
                    'end_date' => $emp->end_date,
                    'position' => $emp->position,
                    'organization' => $emp->organization,
                ];
            });

        // 3. Merge + sort (start_date üzrə artan)
        $allEmployments = $userEmployments
            ->merge($oldEmployments)
            ->sortBy('start_date')
            ->values(); // indexləri reset edir

        // 4. Table clone
        $template->cloneRow('row_no', count($allEmployments));

        // 5. Fill
        foreach ($allEmployments as $index => $emp) {
            $i = $index + 1;

            $template->setValue("row_no#$i", $i);
            $template->setValue(
                "work_period#$i",
                fmtDate($emp['start_date']) . ' - ' . fmtDate($emp['end_date'])
            );
            $template->setValue("position#$i", $emp['position']);
            $template->setValue("fieldX#$i", $emp['organization']);
        }
        // 🔹 FILE SAVE + DOWNLOAD
        $fileName = 'forma 3_' . $fullName . '.docx';
        $tempFile = storage_path($fileName);
        $template->saveAs($tempFile);
        return response()->download($tempFile)->deleteFileAfterSend(true);
        $fileName = 'forma3_' . time() . '.docx';
        $relativePath = 'forms/' . $fileName;

        Storage::disk('public')->put($relativePath, file_get_contents($tempFile));

        $url = asset('storage/' . $relativePath);
        return redirect()->away(
            'https://docs.google.com/gview?url=' . urlencode($url) . '&embedded=true'
        );
    }
    public function exportWordForma2($id)
    {
        function fmtDate($date)
        {
            return $date ? \Carbon\Carbon::parse($date)->format('d.m.Y') : '';
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor(
            storage_path('app/templates/forma_2_temp.docx')
        );

        $user = User::findOrFail($id);

        // 🔹 BASIC INFO
        $template->setValue('lastName', $user->last_name);
        $template->setValue('firstName', $user->first_name);
        $template->setValue('fatherName', $user->father_name);

        $template->setValue(
            'birthAddress',
            fmtDate($user->birth_date) . ', ' . $user->birth_place
        );

        $template->setValue(
            'gender',
            ($user->gender == true) ? 'Qadın' : 'Kişi'
        );

        $template->setValue('citizen', $user->citizen);
        $template->setValue('extraInfo', $user->note);
        $template->setValue('id', $user->serial_no);
        $template->setValue('fin', $user->fin);
        $template->setValue('sin', $user->sin);
        $template->setValue('registeredAddress', $user->registered_address);
        $template->setValue('residentialAddress', $user->residential_address);
        $template->setValue('email', $user->email);
        $template->setValue(
            'maritalStatus',
            ($user->marital_status) ? 'Evli' : 'Subay'
        );

        // 🔹 FOTO
        if ($user->profile_photo_path) {
            $template->setImageValue('profilePhotoPath', [
                'path' => storage_path('app/public/' . $user->profile_photo_path),
                'width' => '4cm',
                'height' => '6cm',

            ]);
        }

        // 1. Yeni employment-lar
        $userEmployments = UserEmployment::with(['position', 'organization'])
            ->where('user_id', $user->id)
            ->get()
            ->map(function ($emp) {
                return [
                    'start_date' => $emp->start_date,
                    'end_date' => $emp->end_date,
                    'position' => optional($emp->position)->name,
                    'organization' => optional($emp->organization)->name,
                ];
            });

        // 2. Köhnə employment-lar
        $oldEmployments = OldUserEmployment::where('user_id', $user->id)
            ->get()
            ->map(function ($emp) {
                return [
                    'start_date' => $emp->start_date,
                    'end_date' => $emp->end_date,
                    'position' => $emp->position,
                    'organization' => $emp->organization,
                ];
            });

        // 3. Merge + sort
        $allEmployments = $userEmployments
            ->merge($oldEmployments)
            ->sortBy('start_date')
            ->values();

        // 4. cloneRow
        $template->cloneRow('workStart', count($allEmployments));

        // 🔹 EDUCATION (təhsil)
        $educations = $user->educations->load('educationType');

        // Təhsil setirləri üçün say
        $eduCount = $educations->whereIn('education_type_id', [1, 2, 3])->count();
        $exEduCount = $educations->whereIn('education_type_id', [4, 5])->count();

        // Normal təhsil setirləri (1,2,3)
        $template->cloneRow('eduOrgName', max(1, $eduCount));
        if ($eduCount > 0) {
            $eduIndex = 1;
            foreach ($educations as $edu) {
                if (in_array($edu->education_type_id, [1, 2, 3])) {
                    $template->setValue("eduOrgName#$eduIndex", $edu->org_name . " (" . optional($edu->educationType)->name . ")");
                    $template->setValue("eduStartDate#$eduIndex", fmtDate($edu->start_date));
                    $template->setValue("eduEndDate#$eduIndex", fmtDate($edu->end_date));
                    $template->setValue("eduSpecialty#$eduIndex", $edu->major);
                    $template->setValue("eduDocNum#$eduIndex", $edu->doc_number . ($edu->doc_date ? ", " . fmtDate($edu->doc_date) : ''));
                    $eduIndex++;
                }
            }
        } else {
            // Boş setir
            $template->setValue("eduOrgName#1", '');
            $template->setValue("eduStartDate#1", '');
            $template->setValue("eduEndDate#1", '');
            $template->setValue("eduSpecialty#1", '');
            $template->setValue("eduDocNum#1", '');
        }

        // Əlavə təhsil setirləri (4,5)
        $template->cloneRow('exEduOrgName', max(1, $exEduCount));
        if ($exEduCount > 0) {
            $exEduIndex = 1;
            foreach ($educations as $edu) {
                if (in_array($edu->education_type_id, [4, 5])) {
                    $template->setValue("exEduOrgName#$exEduIndex", $edu->org_name . " (" . optional($edu->educationType)->name . ")");
                    $template->setValue("exEduStartDate#$exEduIndex", fmtDate($edu->start_date));
                    $template->setValue("exEduEndDate#$exEduIndex", fmtDate($edu->end_date));
                    $template->setValue("exEduSpecialty#$exEduIndex", $edu->major);
                    $template->setValue("exEduDocNum#$exEduIndex", $edu->doc_number . ($edu->doc_date ? ", " . fmtDate($edu->doc_date) : ''));
                    $exEduIndex++;
                }
            }
        } else {
            // Boş setir
            $template->setValue("exEduOrgName#1", '');
            $template->setValue("exEduStartDate#1", '');
            $template->setValue("exEduEndDate#1", '');
            $template->setValue("exEduSpecialty#1", '');
            $template->setValue("exEduDocNum#1", '');
        }

        // 🔹 ACADEMIC DEGREES (elmi dərəcələr)
        $academicDegrees = $user->academicDegrees->load('academicType');
        $academicCount = max(1, $academicDegrees->count());

        $template->cloneRow('academicDegree', $academicCount);

        if ($academicDegrees->isNotEmpty()) {
            $degreeIndex = 1;
            foreach ($academicDegrees as $degree) {
                $template->setValue("academicDegree#$degreeIndex", optional($degree->academicType)->name);
                $template->setValue("academicDegreeDate#$degreeIndex", fmtDate($degree->given_date));
                $template->setValue("academicOrg#$degreeIndex", $degree->given_org);
                $template->setValue("academicDoc#$degreeIndex", $degree->doc_number . ($degree->doc_date ? ", " . fmtDate($degree->doc_date) : ''));
                $degreeIndex++;
            }
        } else {
            // Boş setir
            $template->setValue("academicDegree#1", '');
            $template->setValue("academicDegreeDate#1", '');
            $template->setValue("academicOrg#1", '');
            $template->setValue("academicDoc#1", '');
        }

        // 🔹 LANGUAGES (dillər)
        $userLanguages = $user->userLanguages->load(['language', 'languageLevel']);
        $languageCount = max(1, $userLanguages->count());

        $template->cloneRow('language', $languageCount);

        if ($userLanguages->isNotEmpty()) {
            $langIndex = 1;
            foreach ($userLanguages as $ul) {
                $template->setValue("language#$langIndex", optional($ul->language)->name);
                $template->setValue("langLevel#$langIndex", optional($ul->languageLevel)->name);
                $langIndex++;
            }
        } else {
            // Boş setir
            $template->setValue("language#1", '');
            $template->setValue("langLevel#1", '');
        }

        // 🔹 COMPUTER SKILLS (kompüter bilikləri)
        $computerSkills = $user->computerKnowledges->load('skill')
            ->pluck('skill.name')
            ->filter()
            ->implode(', ');
        $template->setValue('computerKnowledges', $computerSkills ?: '');
        // 🔹 MILITARY RANKS (hərbi rütbələr)
        $ranks = $user->militaries->pluck('rank')->filter()->implode(', ');

        if ($ranks) {
            $ranks = "{Dövlət qulluğunun ixtisas dərəcəsi}, " . $ranks;
        } else {
            $ranks = "{Dövlət qulluğunun ixtisas dərəcəsi}";
        }
        $template->setValue('professionalQualification', $ranks ?: '');

        // 5. Fill
        foreach ($allEmployments as $i => $emp) {
            $index = $i + 1;

            $template->setValue("workStart#$index", fmtDate($emp['start_date']));
            $template->setValue("workEnd#$index", fmtDate($emp['end_date']));
            $template->setValue("workPlace#$index", $emp['organization']);
            $template->setValue("position#$index", $emp['position']);
        }

        // 🔹 MILITARY
        $militaries = Military::where('user_id', $user->id)->get();

        $militaryText = $militaries->map(function ($m) {
            return $m->rank . ' və ' . fmtDate($m->service_date);
        })->implode(', ');

        $template->setValue('militaries', $militaryText);

        // 🔹 CRIMINAL RECORDS
        $crimes = CriminalRecord::where('user_id', $user->id)->get();

        $crimeText = $crimes->map(function ($c) {
            return fmtDate($c->date) . ', ' . $c->reason;
        })->implode("\n");

        $template->setValue('crimes', $crimeText);

        // 🔹 NAME CHANGE
        $nameChanges = NameChange::where('user_id', $user->id)->get();

        $oldNames = $nameChanges->map(function ($n) {
            return $n->old_first_name . ' ' . $n->old_last_name . ' ' . $n->old_father_name
                . "\n" . fmtDate($n->date) . ', ' . $n->reason;
        })->implode("\n");

        $template->setValue('oldNameChange', $oldNames);

        // 🔹 RELATIVES
        $relatives = UserRelative::with('relationshipType')
            ->where('user_id', $user->id)
            ->get();

        $count = max(1, $relatives->count()); // minimum 1 sətir

        $template->cloneRow('kinship', $count);

        if ($relatives->isEmpty()) {
            // boş sətir
            $template->setValue("kinship#1", '');
            $template->setValue("kinshipFullName#1", '');
            $template->setValue("kinshipbirth#1", '');
            $template->setValue("kinshipwork#1", '');
            $template->setValue("kinshipaddress#1", '');
        } else {
            foreach ($relatives as $i => $r) {
                $index = $i + 1;

                $template->setValue("kinship#$index", optional($r->relationshipType)->name);
                $template->setValue("kinshipFullName#$index", $r->full_name);
                $template->setValue("kinshipbirth#$index", fmtDate($r->birth_date));
                $template->setValue("kinshipwork#$index", $r->workplace . ', ' . $r->position);
                $template->setValue("kinshipaddress#$index", $r->registered_address);
            }
        }
        // 🔹 PHONES
        $workPhone = Phone::where('user_id', $user->id)
            ->where('phone_type_id', 3)
            ->value('number');

        $mobilePhone = Phone::where('user_id', $user->id)
            ->where('phone_type_id', 1)
            ->value('number');

        // Template-ə göndər
        $template->setValue('workphonenumber', $workPhone);
        $template->setValue('mobilphonenumber', $mobilePhone);

        // 🔹 CURRENT DATE
        $now = now();

        $template->setValue('cdday', $now->format('d'));
        $months = [
            1 => 'yanvar',
            2 => 'fevral',
            3 => 'mart',
            4 => 'aprel',
            5 => 'may',
            6 => 'iyun',
            7 => 'iyul',
            8 => 'avqust',
            9 => 'sentyabr',
            10 => 'oktyabr',
            11 => 'noyabr',
            12 => 'dekabr',
        ];

        $template->setValue('cdmonth', $months[$now->month]);
        $template->setValue('cdyear', $now->format('y'));

        // 🔹 SAVE
        $fileName = 'forma_2_' . $user->first_name . '.docx';
        $tempFile = storage_path($fileName);

        $template->saveAs($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
