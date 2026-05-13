<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Structure\OrgDepartmentController;
use App\Http\Controllers\Structure\FormInfo;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Education\EducationController;
use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::get('/kadr-ucotu', function () {
    return view('pages.staff.personnel-accounting');
})->name('pages.staff.personnel-accounting');
Route::get('/ise-qebul', function () {
    return view('pages.job-acceptance');
})->name('job-acceptance');
// Route::get('/arxiv', function () {
//     return view('pages.staff.personnel-accounting');
// })->name('pages.staff.personnel-accounting');
Route::prefix('struktur')->group(function () {
    // Əsas struktur
    Route::get('/', [OrgDepartmentController::class, 'index'])
        ->name('structure');
    Route::post('/', [OrgDepartmentController::class, 'store'])
        ->name('structure.store');
    Route::post('/yenile', [OrgDepartmentController::class, 'update'])
        ->name('structure.update');
    Route::post('/deyis', [OrgDepartmentController::class, 'change'])
        ->name('structure.change');
    Route::get('/{id}/staff-table', [OrgDepartmentController::class, 'staffTable'])
        ->name('structure.staff-table');
    // Struktur ətraflı (employee page)
    Route::prefix('struktur-etrafli')->group(function () {

        // 🔥 əvvəl static route-lar
        Route::get('/get-relationship-types', [FormInfo::class, 'getRelationshipTypes'])
            ->name('structure.employee.get.relationship.types');
        Route::get('/get-military-types', [FormInfo::class, 'getMilitaryTypes'])
            ->name('structure.employee.get.military.types');
        Route::get('/get-phone-types', [FormInfo::class, 'getPhoneTypes'])
            ->name('structure.employee.get.phone.types');
        Route::get('/{id}', [OrgDepartmentController::class, 'employee'])
            ->name('structure.employee');
        // İşçi əməliyyatları
        Route::post('/emekdas', [OrgDepartmentController::class, 'employee_store'])
            ->name('structure.employee.store');
        Route::post('/emekdas-yenile', [OrgDepartmentController::class, 'employee_update'])
            ->name('structure.employee.update');
        Route::post('/rol-yenile', [OrgDepartmentController::class, 'role_update'])
            ->name('structure.role.update');
        Route::post('/emekdas-arxivle', [OrgDepartmentController::class, 'archive_employment'])
            ->name('structure.employment.archive');
        // Müqavilə
        Route::post('/muqavile-yarat', [OrgDepartmentController::class, 'employee_employment_store'])
            ->name('structure.employment.store');
        // FIN yoxlama
        Route::post('/fin-yoxla', [OrgDepartmentController::class, 'checkFin'])
            ->name('employee.check-fin');
        // Vəzifə əməliyyatları
        Route::post('/vezife', [OrgDepartmentController::class, 'position_store'])
            ->name('structure.position.store');
        Route::post('/vezife-yenile', [OrgDepartmentController::class, 'position_update'])
            ->name('structure.positions.update');
        Route::post('/vezife-sil', [OrgDepartmentController::class, 'position_delete'])
            ->name('structure.positions.delete');
        // Struktur yeniləmə
        Route::put('/struktur-yenile', [OrgDepartmentController::class, 'structure_structure_update'])
            ->name('structure.structure.update');
        // Qohum
        Route::post('/forma-emeliyyat', [FormInfo::class, 'handleFormAction'])
            ->name('structure.handle-form-action');
        Route::get('/{userId}/get-all-data', [FormInfo::class, 'getAllUserData'])
            ->name('structure.get.user.data');
    });
});
Route::prefix('kadr-ucotu')->group(function () {

    // Əsas səhifə
    Route::get('/', function () {
        return view('pages.staff.personnel-accounting');
    })->name('pages.staff.personal-accounting');

    Route::prefix('kadr-senedleri')->group(function () {

        // Əsas
        Route::get('/', [StaffController::class, 'personnelDocuments'])
            ->name('personal.document');
        Route::post('/sened-elave-et', [StaffController::class, 'personnelDocumentStore'])
            ->name('personal.document.store');

        // Validate
        Route::post('/validate-document', function (Request $request) {
            $req = new \App\Http\Requests\StoreDocumentRequest();
            return $req->validateJson($request->all());
        })->name('validate.document');

        // User
        Route::get('/user/{id}', [StaffController::class, 'getUserDocData'])
            ->name('user.data');

        // Delete
        Route::delete('/sened-sil/{id}', [StaffController::class, 'destroyDocument'])
            ->name('destroy.document');
        Route::delete('/sened-yukle/user/{id}', [StaffController::class, 'destroyDocument'])
            ->name('destroy.document.upload');

        // Export
        Route::get('/forma-3/user/{id}', [StaffController::class, 'exportWordForma3'])
            ->name('user.export.word.forma.3');
        Route::get('/forma-2/user/{id}', [StaffController::class, 'exportWordForma2'])
            ->name('user.export.word.forma.2');

        // AJAX
        Route::get('/get-departments-by-organization', [StaffController::class, 'getDepartmentsByOrganization'])
            ->name('get-departments-by-organization');
        Route::get('/get-sectors-by-organization', [StaffController::class, 'getSectorsByOrganization'])
            ->name('get-sectors-by-organization');
        Route::get('/get-sectors-by-department', [StaffController::class, 'getSectorsByDepartment'])
            ->name('get-sectors-by-department');
        Route::get('/get-users-by-organization', [StaffController::class, 'getUsersByOrganization'])
            ->name('get-users-by-organization');
        Route::get('/get-users-by-department', [StaffController::class, 'getUsersByDepartment'])
            ->name('get-users-by-department');
        Route::get('/get-users-by-sector', [StaffController::class, 'getUsersBySector'])
            ->name('get-users-by-sector');
        Route::get('/get-position-by-user', [StaffController::class, 'getPositionByUser'])
            ->name('get-position-by-user');
    });
});

Route::prefix('tehsil-pesekar-inkisaf')->group(function () {

    // Əsas səhifə
    Route::get('/', [EducationController::class, 'index'])
    ->name('education');

    Route::get('/education-types', [EducationController::class, 'getEducationTypes'])
        ->name('education-types');
    Route::get('/academic-types', [EducationController::class, 'getAcademicTypes'])
        ->name('academic-types');
    Route::get('/language-levels', [EducationController::class, 'getLanguageLevels'])
        ->name('language-levels');
    Route::get('/languages', [EducationController::class, 'getLanguages'])
        ->name('languages');
    Route::get('computer-skills', [EducationController::class, 'getSkills'])
    ->name('computer.skills');
    Route::prefix('/user/{userId}')->group(function () {
        Route::get('/data', [EducationController::class, 'getUserData']);
        Route::post('/education', [EducationController::class, 'saveEducation']);
        Route::post('/academic-degree', [EducationController::class, 'saveAcademicDegree']);
        Route::post('/computer-knowledge', [EducationController::class, 'saveComputerKnowledge']);
        Route::post('/language', [EducationController::class, 'saveLanguage']);
        Route::post('/course', [EducationController::class, 'saveCourse']);
        Route::post('/training', [EducationController::class, 'saveTraining']);
        
        Route::delete('/education/{id}', [EducationController::class, 'deleteEducation']);
        Route::delete('/academic-degree/{id}', [EducationController::class, 'deleteAcademicDegree']);
        Route::delete('/computer-knowledge/{id}', [EducationController::class, 'deleteComputerKnowledge']);
        Route::delete('/language/{id}', [EducationController::class, 'deleteLanguage']);
        Route::delete('/course/{id}', [EducationController::class, 'deleteCourse']);
        Route::delete('/training/{id}', [EducationController::class, 'deleteTraining']);
    });
});






Route::get('/kadr-ucotu/kadr-senedleri-etrafli/sertifikatlar', function () {
    return view('pages.certificates');
})->name('certificates');
Route::get('/kadr-ucotu/kadr-senedleri-etrafli/emr', function () {
    return view('pages.order');
})->name('order');
Route::get('/kadr-ucotu/kadr-senedleri-etrafli/muqavile', function () {
    return view('pages.contract');
})->name('contract');
Route::get('/mezuniyyet-qrafiki', function () {
    return view('pages.graduation-schedule');
})->name('graduation-schedule');
Route::get('/icaze-qrafiki', function () {
    return view('pages.permission-schedule');
})->name('permission-schedule');
Route::get('/qiymetlendirme', function () {
    return view('pages.evaluation');
})->name('evaluation');
Route::get('/qiymetlendirme-elave', function () {
    return view('pages.evaluation-add');
})->name('evaluation-add');
Route::get('/qiymetlendirme-siyahi', function () {
    return view('pages.evaluation-list');
})->name('evaluation-list');
Route::get('/qiymetlendirme-redakte-et', function () {
    return view('pages.evaluation-edit');
})->name('evaluation-edit');
Route::get('/qiymetlendirme-bax', function () {
    return view('pages.evaluation-view');
})->name('evaluation-view');

Route::get('/telim', function () {
    return view('pages.training');
})->name('training');
Route::get('/telim-ehtiyaclari', function () {
    return view('pages.training-needs');
})->name('training-needs');
Route::get('/telim-planlaması', function () {
    return view('pages.training-planning');
})->name('training-planning');
Route::get('/namized-bazasi', function () {
    return view('pages.candidate-database');
})->name('candidate-database');
Route::get('/musahibe-planlama', function () {
    return view('pages.interview-planning');
})->name('interview-planning');
Route::get('/test', function () {
    return view('pages.test');
})->name('test');
