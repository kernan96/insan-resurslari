<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Structure\OrgDepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\Education\AcademicDegree;
use App\Models\Education\AcademicType;
use App\Models\Education\ComputerKnowledge;
use App\Models\Education\ComputerSkill;
use App\Models\Education\Education;
use App\Models\Education\EducationType;
use App\Models\Education\Language;
use App\Models\Education\LanguageLevel;
use App\Models\Education\UserEvent;
use App\Models\Education\UserLanguage;
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
use Illuminate\Http\JsonResponse;


class EducationController extends Controller
{
    public function index()
    {
        // Aktiv işçiləri əldə et
        $users = User::whereHas('activeEmployment', function ($q) {
            $q->where('status', true);
        })
            ->with(['orgPosition.organizationDepartment', 'activeEmployment'])
            ->get();

        return view('pages.education.education', compact('users'));
    }
    public function getEducationTypes()
    {
        $types = EducationType::where('id', '<', 6)
            ->select('id', 'name')
            ->get();

        return response()->json($types);
    }
    public function getAcademicTypes()
    {
        $types = AcademicType::select('id', 'name')->get();
        return response()->json($types);
    }

    public function getLanguageLevels()
    {
        $levels = LanguageLevel::select('id', 'name')->get();
        return response()->json($levels);
    }
    public function getLanguages()
    {
        $languages = Language::select('id', 'name', 'key_words', 'code')
            ->orderBy('name')
            ->get();
        return response()->json($languages);
    }
    public function getSkills()
    {
        $skills = ComputerSkill::select('id', 'name', 'key_words')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($skills);
    }
    // Bütün user datalarını bir dəfəyə qaytar
    public function getUserData($userId)
    {
        $user = User::with([
            'educations.educationType',
            'academicDegrees.academicType',
            'userLanguages.language',
            'userLanguages.languageLevel',
            'computerKnowledges.skill'
        ])->findOrFail($userId);

        return response()->json([
            'education' => $user->educations->filter(function ($e) {
                return $e->education_type_id < 6;
            })->map(function ($e) {
                return [
                    'id' => $e->id,
                    'education_type_id' => $e->education_type_id,
                    'education_type_name' => $e->educationType?->name,
                    'institution' => $e->org_name,
                    'start_date' => $e->start_date,
                    'end_date' => $e->end_date,
                    'specialty' => $e->major,
                    'document_info' => $e->doc_number . ' ' . $e->doc_date,
                    'document_link' => $e->doc_path
                ];
            })->values(),
            'academic-degree' => $user->academicDegrees->map(function ($a) {
                return [
                    'id' => $a->id,
                    'academic_type_id' => $a->academic_type_id,
                    'academic_type_name' => $a->academicType?->name,
                    'issue_date' => $a->given_date,
                    'issued_by' => $a->given_org,
                    'document_no' => $a->doc_number . ' ' . $a->doc_date,
                    'document_link' => $a->doc_path
                ];
            }),
            'language' => $user->userLanguages->map(function ($l) {
                return [
                    'id' => $l->id,
                    'language_id' => $l->language_id,
                    'language_name' => $l->language?->name,
                    'level_id' => $l->language_level_id,
                    'level_name' => $l->languageLevel?->name
                ];
            }),
            'computer-knowledge' => $user->computerKnowledges->map(function ($c) {
                return [
                    'id' => $c->id,
                    'skill_id' => $c->skill_id,
                    'skill_name' => $c->skill?->name
                ];
            }),
            'course' => $user->educations->where('education_type_id', 6)->map(function ($c) {
                return [
                    'id' => $c->id,
                    'course_name' => $c->org_name,
                    'certificate' => $c->doc_path
                ];
            })->values(),
            'training' => $user->educations->where('education_type_id', 7)->map(function ($t) {
                return [
                    'id' => $t->id,
                    'training_name' => $t->org_name,
                    'certificate' => $t->doc_path
                ];
            })->values()
        ]);
    }

    // Education - Əlavə et / Yenilə
    public function saveEducation(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'id' => 'nullable|exists:education,id',
                'education_type_id' => 'required|exists:education_types,id',
                'institution' => 'required|string',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'specialty' => 'nullable|string',
                'document_info' => 'nullable|string',
                'document_file' => 'nullable|file|mimes:pdf|max:400' // 400KB = 400
            ]);

            $educationData = [
                'user_id' => $userId,
                'education_type_id' => $data['education_type_id'],
                'org_name' => $data['institution'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'major' => $data['specialty'],
                'doc_number' => $data['document_info'],
                'doc_date' => null
            ];

            // Fayl yükləmə
            if ($request->hasFile('document_file')) {
                $file = $request->file('document_file');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('education/documents', $filename, 'public');
                $educationData['doc_path'] = '/storage/' . $path;
            } elseif (isset($data['id'])) {
                // Redaktə zamanı mövcud faylı saxla
                $existingEducation = Education::find($data['id']);
                if ($existingEducation) {
                    $educationData['doc_path'] = $existingEducation->doc_path;
                }
            }

            $education = Education::updateOrCreate(
                ['id' => $data['id'] ?? null, 'user_id' => $userId],
                $educationData
            );

            return response()->json([
                'success' => true,
                'id' => $education->id,
                'message' => 'Təhsil məlumatı uğurla yadda saxlanıldı'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation xətası: ' . implode(', ', $e->errors()['education_type_id'] ?? ['Məlumatları düzgün daxil edin'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    // Academic Degree
    public function saveAcademicDegree(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'id' => 'nullable|exists:academic_degrees,id',
                'academic_type_id' => 'required|exists:academic_types,id',
                'issue_date' => 'nullable|date',
                'issued_by' => 'nullable|string',
                'document_no' => 'nullable|string',
                'document_file' => 'nullable|file|mimes:pdf|max:400'
            ]);

            $degreeData = [
                'user_id' => $userId,
                'academic_type_id' => $data['academic_type_id'],
                'given_date' => $data['issue_date'],
                'given_org' => $data['issued_by'],
                'doc_number' => $data['document_no'],
                'doc_date' => null
            ];

            // Fayl yükləmə
            if ($request->hasFile('document_file')) {
                $file = $request->file('document_file');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('academic/documents', $filename, 'public');
                $degreeData['doc_path'] = '/storage/' . $path;
            } elseif (isset($data['id'])) {
                // Redaktə zamanı mövcud faylı saxla
                $existingDegree = AcademicDegree::find($data['id']);
                if ($existingDegree) {
                    $degreeData['doc_path'] = $existingDegree->doc_path;
                }
            }

            $degree = AcademicDegree::updateOrCreate(
                ['id' => $data['id'] ?? null, 'user_id' => $userId],
                $degreeData
            );

            return response()->json([
                'success' => true,
                'id' => $degree->id,
                'message' => 'Elmi dərəcə uğurla yadda saxlanıldı'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation xətası: ' . implode(', ', $e->errors()['academic_type_id'] ?? ['Məlumatları düzgün daxil edin'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveComputerKnowledge(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'skill_ids' => 'required|array',
                'skill_ids.*' => 'exists:computer_skills,id'
            ]);

            // Mövcud bacarıqları al
            $existingSkills = ComputerKnowledge::where('user_id', $userId)
                ->pluck('skill_id')
                ->toArray();

            // Yeni göndərilən bacarıqlar
            $newSkills = $data['skill_ids'];



            // Əlavə ediləcək bacarıqlar (yenidə var, köhnədə yox)
            $skillsToAdd = array_diff($newSkills, $existingSkills);

            // Silinəcək bacarıqları sil
            if (!empty($skillsToDelete)) {
                ComputerKnowledge::where('user_id', $userId)
                    ->whereIn('skill_id', $skillsToDelete)
                    ->delete();
            }

            // Yeni bacarıqları əlavə et
            foreach ($skillsToAdd as $skillId) {
                ComputerKnowledge::create([
                    'user_id' => $userId,
                    'skill_id' => $skillId
                ]);
            }

            $message = [];
            if (!empty($skillsToAdd)) $message[] = count($skillsToAdd) . ' yeni bacarıq əlavə edildi';
            if (!empty($skillsToDelete)) $message[] = count($skillsToDelete) . ' bacarıq silindi';
            if (empty($skillsToAdd) && empty($skillsToDelete)) $message[] = 'Heç bir dəyişiklik edilmədi';

            return response()->json([
                'success' => true,
                'message' => implode(', ', $message)
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation xətası: ' . implode(', ', $e->errors()['skill_ids'] ?? ['Bacarqları düzgün seçin'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    // Language
    public function saveLanguage(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'id' => 'nullable|exists:user_languages,id',
                'language_id' => 'required|exists:languages,id',
                'level_id' => 'required|exists:language_levels,id'
            ]);

            // Əgər id varsa (redaktə), birbaşa yenilə
            if (!empty($data['id'])) {
                $language = UserLanguage::where('id', $data['id'])
                    ->where('user_id', $userId)
                    ->first();

                if ($language) {
                    $language->update([
                        'language_id' => $data['language_id'],
                        'language_level_id' => $data['level_id']
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Dil uğurla yeniləndi',
                        'id' => $language->id
                    ]);
                }
            }

            // Yeni əlavə - eyni dilin olub olmadığını yoxla
            $existingLanguage = UserLanguage::where('user_id', $userId)
                ->where('language_id', $data['language_id'])
                ->first();

            if ($existingLanguage) {
                // Əgər varsa, sadəcə səviyyəni yenilə
                $existingLanguage->update([
                    'language_level_id' => $data['level_id']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Dil artıq mövcud idi, səviyyə yeniləndi',
                    'id' => $existingLanguage->id
                ]);
            }

            // Yoxdursa, yenisini yarat
            $language = UserLanguage::create([
                'user_id' => $userId,
                'language_id' => $data['language_id'],
                'language_level_id' => $data['level_id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Dil uğurla əlavə edildi',
                'id' => $language->id
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation xətası: ' . implode(', ', $e->errors()['language_id'] ?? ['Məlumatları düzgün daxil edin'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveCourse(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'id' => 'nullable|integer|exists:education,id',
                'course_name' => 'required|string|max:255',
                'certificate' => 'nullable|file|mimes:pdf|max:400'
            ]);

            $courseData = [
                'user_id' => $userId,
                'org_name' => $data['course_name'],
                'major' => $data['course_name'],
                'education_type_id' => 6, // Kurs üçün
                'doc_number' => null,
                'doc_date' => null
            ];

            // Sertifikat faylı varsa yüklə
            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('education/certificates', $filename, 'public');
                $courseData['doc_path'] = '/storage/' . $path;
            } elseif (isset($data['certificate']) && is_string($data['certificate'])) {
                // Redaktə zamanı mövcud fayl yolunu saxla
                $existingCourse = Education::find($data['id']);
                if ($existingCourse) {
                    $courseData['doc_path'] = $existingCourse->doc_path;
                }
            }

            $course = Education::updateOrCreate(
                ['id' => $data['id'] ?? null, 'user_id' => $userId],
                $courseData
            );

            return response()->json([
                'success' => true,
                'message' => 'Kurs uğurla yadda saxlanıldı',
                'id' => $course->id,
                'course_name' => $course->org_name,
                'certificate' => $course->doc_path
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation xətası: ' . implode(', ', $e->errors()['course_name'] ?? ['Məlumatları düzgün daxil edin'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveTraining(Request $request, $userId)
    {
        try {
            $data = $request->validate([
                'id' => 'nullable|integer|exists:education,id',
                'training_name' => 'required|string|max:255',
                'certificate' => 'nullable|file|mimes:pdf|max:400'
            ]);

            $trainingData = [
                'user_id' => $userId,
                'org_name' => $data['training_name'],
                'major' => $data['training_name'],
                'education_type_id' => 7, // Təlim üçün
                'doc_number' => null,
                'doc_date' => null
            ];

            // Sertifikat faylı varsa yüklə
            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('education/certificates', $filename, 'public');
                $trainingData['doc_path'] = '/storage/' . $path;
            } elseif (isset($data['certificate']) && is_string($data['certificate'])) {
                // Redaktə zamanı mövcud fayl yolunu saxla
                $existingTraining = Education::find($data['id']);
                if ($existingTraining) {
                    $trainingData['doc_path'] = $existingTraining->doc_path;
                }
            }

            $training = Education::updateOrCreate(
                ['id' => $data['id'] ?? null, 'user_id' => $userId],
                $trainingData
            );

            return response()->json([
                'success' => true,
                'message' => 'Təlim uğurla yadda saxlanıldı',
                'id' => $training->id,
                'training_name' => $training->org_name,
                'certificate' => $training->doc_path
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation xətası: ' . implode(', ', $e->errors()['training_name'] ?? ['Məlumatları düzgün daxil edin'])
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteCourse($userId, $id)
    {
        try {
            $course = Education::where('id', $id)
                ->where('user_id', $userId)
                ->where('education_type_id', 6)
                ->first();

            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kurs tapılmadı'
                ], 404);
            }

            // Faylı sil
            if ($course->doc_path && file_exists(public_path($course->doc_path))) {
                unlink(public_path($course->doc_path));
            }

            $course->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kurs uğurla silindi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Silinərkən xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteTraining($userId, $id)
    {
        try {
            $training = Education::where('id', $id)
                ->where('user_id', $userId)
                ->where('education_type_id', 7)
                ->first();

            if (!$training) {
                return response()->json([
                    'success' => false,
                    'message' => 'Təlim tapılmadı'
                ], 404);
            }

            // Faylı sil
            if ($training->doc_path && file_exists(public_path($training->doc_path))) {
                unlink(public_path($training->doc_path));
            }

            $training->delete();

            return response()->json([
                'success' => true,
                'message' => 'Təlim uğurla silindi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Silinərkən xəta: ' . $e->getMessage()
            ], 500);
        }
    }

    // DELETE metodları
    public function deleteEducation($userId, $id)
    {
        Education::where('id', $id)->where('user_id', $userId)->delete();
        return response()->json(['success' => true]);
    }

    public function deleteAcademicDegree($userId, $id)
    {
        AcademicDegree::where('id', $id)->where('user_id', $userId)->delete();
        return response()->json(['success' => true]);
    }

    public function deleteComputerKnowledge($userId, $id)
    {
        ComputerKnowledge::where('id', $id)->where('user_id', $userId)->delete();
        return response()->json(['success' => true]);
    }

    public function deleteLanguage($userId, $id)
    {
        UserLanguage::where('id', $id)->where('user_id', $userId)->delete();
        return response()->json(['success' => true]);
    }
}
