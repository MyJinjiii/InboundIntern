<?php

use App\Http\Middleware\admin;
use App\Http\Controllers\scholarshipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AlluserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditRoleController;
use App\Http\Controllers\Admin\FileManagementController;
use App\Http\Controllers\Admin\ManageAdvisorController;
use App\Http\Controllers\Admin\ManageScholarshipController;
use App\Http\Controllers\Admin\ManagenonScholarshipController;
use App\Http\Controllers\Admin\PassIntroController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Advisor\AdvisorController;
use App\Http\Controllers\LogoController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/index', [UserController::class, 'index'])->name('index');
route::get('', [LogoController::class, 'index'])->name('homepage');
Route::get('change', action: [UserController::class, 'change'])->name('change');
Route::post('/user/update-name', [UserController::class, 'updateName'])->name('user.updateName');
Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');



Route::middleware('user')->prefix('user')->group(function () {
    Route::get('form/{topic_id}/{id}', [UserController::class, 'form'])->name('form');
    Route::post('form/{topic_id}/{id}', [scholarshipController::class, 'store'])->name('scholarship_store');
    Route::get('form', [UserController::class, 'nonform'])->name('nonform');
    Route::post('form/{id}/status_store', [UserController::class, 'status_store'])->name('status_store');
    route::get('status/{id}', [ScholarshipController::class, 'show'])->name('user.status');

    // Update info หน้า Status
    Route::post('update/person/{id}', [UserController::class, 'person_update'])->name('person_update');
    Route::post('update/edu/{id}', [UserController::class, 'edu_update'])->name('edu_update');
    Route::post('update/file/{id}', [UserController::class, 'file_update'])->name('file_update');
    Route::post('update/confirm_right/{id}', [UserController::class, 'confirm_right'])->name('confirm_right');


});
Route::middleware(['auth', 'advisor'])->prefix('advisor')->group(function () {

    Route::get('/index_advisor', [AdvisorController::class, 'index'])->name('Advisor.index');
    Route::put('/index_advisor/{id}', [AdvisorController::class, 'updateprogram'])->name('Program.update');

    Route::get('/form_advisor', [AdvisorController::class, 'create'])->name('Advisor.create');
    Route::post('/index_advisor', [AdvisorController::class, 'store'])->name('Advisor.store');
    Route::get('/scholarship_advisor', [AdvisorController::class, 'show'])->name('Advisor.show');
    Route::post('/scholarship_advisor/{info_id}', [AdvisorController::class, 'update'])->name('Advisor.update');
});



/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/


Route::middleware(['auth', 'admin'])->group(function () {
    // ตราบใดที่มีการเรียกใช้งาน middleware มากกว่าหนึ่งตัว ให้ใช้รูปแบบของรายการ  
    Route::get('/editrole', [EditRoleController::class, 'index'])->name('editrole');
    Route::post('/editrole/{id}', [EditRoleController::class, 'updateUserType'])->name('updateUserType');
    Route::delete('/editrole/{id}', [EditRoleController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/useredit', [AlluserController::class, 'index'])->name('alluser');
    Route::get('/scholarship', [ManageScholarshipController::class, 'index'])->name('scholarship');
    Route::post('/scholarship/{id}/update', [ManageScholarshipController::class, 'update'])->name('post.scholarship');
    Route::post('/scholarship/{info_id}/interview_result', [ManageScholarshipController::class, 'interview_result'])->name('interview_result_scholarship');
    Route::post('/scholarship/{info_id}/upload_LOA', [ManageScholarshipController::class, 'LOA'])->name('LOA');
    Route::post('/scholarship/{info_id}/comment', [ManageScholarshipController::class, 'comment'])->name('comment');

    Route::get('/pansumpad', [PassIntroController::class, 'index'])->name('pansumpad');
    Route::get('/nonscholarship', [ManageNonScholarshipController::class, 'index'])->name('nonscholarship');

    route::get('/allprogram', [ProgramController::class, 'index'])->name('allprogram');
    Route::post('/allprogram', [ProgramController::class, 'store'])->name('programs.store');
    // route::post('/allprogram/{id}/destroy', [ProgramController::class, 'destroy'])->name('allprogram.destroy');
    route::put('/allprogram/{id}/update', [ProgramController::class, 'updateapprove'])->name('allprogram.update');

    Route::get('approve', [ProgramController::class, 'approve'])->name('Program.approve');
    route::put('/approve/{id}/update', [ProgramController::class, 'updatenotapprove'])->name('allprogram.researchnotapprove');
    Route::delete('/approve/{id}', [ProgramController::class, 'destroy'])->name('Program.destroy');
    Route::get('/advisor', [ManageAdvisorController::class, 'index'])->name('advisor');
    Route::post('/advisor/create/', [ManageAdvisorController::class, 'store'])->name('advisor.create');

    Route::get('/announcement', [FileManagementController::class, 'index'])->name('ann');
    Route::post('/announcement/full_ann', [FileManagementController::class, 'full_ann'])->name('full_ann');
    Route::post('/announcement/final_ann', [FileManagementController::class, 'final_ann'])->name('final_ann');
    Route::delete('/announcement/full_ann_delete/{id}', [FileManagementController::class, 'full_ann_delete'])->name('full_ann_delete');
    Route::delete('/announcement/final_ann_delete/{id}', [FileManagementController::class, 'final_ann_delete'])->name('final_ann_delete');


    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting/cover', [SettingController::class, 'cover'])->name('cover');
    Route::put('/setting/cover/{id}', [SettingController::class, 'update'])->name('cover.update');
    Route::delete('/setting/cover/{id}', [SettingController::class, 'destroy'])->name('cover.destroy');

    Route::post('/setting/edit', [SettingController::class, 'round'])->name('round');

    Route::put('/setting/regis/{id}', [SettingController::class, 'updateRegisStatus'])->name('updateRegis');

    Route::put('/setting/edit/{id}', [SettingController::class, 'updateEditStatus'])->name('updateEdit');

    Route::put('/setting/confirm/{id}', [SettingController::class, 'updateConfirmStatus'])->name('updateConfirm');

    Route::put('/setting/dateend/{id}', [SettingController::class, 'updatedateend'])->name('updatedateend');



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/get-programs/{year_id}', [DashboardController::class, 'getPrograms']);
    Route::get('/get-users/{program_id}', [DashboardController::class, 'getUsers']);

    Route::get('/export-all-students', [DashboardController::class, 'exportAllStudents']);
    Route::get('/export-students-by-year', [DashboardController::class, 'exportStudentsByYear']);
    Route::get('/export-students-by-program', [DashboardController::class, 'exportStudentsByProgram']);


    Route::get('/navigation', function () {
        return view('layouts/navigation');
    })->name('navigation');

    Route::get('/sidebar', function () {
        return view('layouts/sidebar');
    })->name('sidebar');
});
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/superadmin/edit', function () {
        return view('superadmin.edit');
    })->name('superadmintest');
});

require __DIR__ . '/auth.php';

Route::get('user/status2', function () {
    return view('user/status2');
})->name('status2');
