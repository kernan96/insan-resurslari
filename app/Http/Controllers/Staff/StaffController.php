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
                $q->whereIn('id', $departmentIds);
            })
            ->whereHas('activeEmployment') // yalnız aktiv employment olanlar
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

        $template->setValue("field3", "//back'i yazılmayıb");
        $template->setValue("field5", "//back'i yazılmayıb");
        $template->setValue("field6", "//back'i yazılmayıb");
        $template->setValue("field7", "//back'i yazılmayıb");
        $template->setValue("field8", "//back'i yazılmayıb");
        $template->setValue("field9", "//back'i yazılmayıb");
        $template->setValue("field10", "//back'i yazılmayıb");
        // 🔥 USER EMPLOYMENTS (dynamic table)

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
        return response()->file($tempFile);
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
        $template->setValue('maritalStatus', $user->marital_status);

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
            return $n->old_first_name . ' ' . $n->old_last_name . ' ' . $n->old_father_name;
        })->implode(', ');

        $template->setValue('oldNameChange', $oldNames);

        // 🔹 RELATIVES
        $relatives = UserRelative::with('relationshipType')
            ->where('user_id', $user->id)
            ->get();

        $template->cloneRow('kinship', count($relatives));

        foreach ($relatives as $i => $r) {
            $index = $i + 1;

            $template->setValue("kinship#$index", optional($r->relationshipType)->name);
            $template->setValue("kinshipFullName#$index", $r->full_name);
            $template->setValue("kinshipbirth#$index", fmtDate($r->birth_date));
            $template->setValue("kinshipwork#$index", $r->workplace . ' ' . $r->position);
            $template->setValue("kinshipaddress#$index", $r->registered_address);
        }

        // 🔹 CURRENT DATE
        $now = now();

        $template->setValue('cdday', $now->format('d'));
        $template->setValue('cdmonth', $now->format('m'));
        $template->setValue('cdyear', $now->format('y'));

        // 🔹 SAVE
        $fileName = 'forma_2_' . $user->first_name . '.docx';
        $tempFile = storage_path($fileName);

        $template->saveAs($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
