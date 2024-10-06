<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CRUDs\DashboardController;
use App\Http\Controllers\CRUDs\EducationInformationController;
use App\Http\Controllers\CRUDs\FamilyInformationController;
use App\Http\Controllers\CRUDs\PersonalInformationController;
use App\Http\Controllers\CRUDs\ProfileController;
use App\Http\Controllers\CRUDs\StudentInformationController;
use App\Http\Controllers\CRUDs\StudentManagementController;
use App\Http\Controllers\CRUDs\TeacherManagementController;

Route::redirect('/', '/login');
Route::redirect('/logout', '/login');

Route::middleware(['guest'])->group(function () {
    // Auth.
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    // Auth.
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Profile.
    Route::resource('profile', ProfileController::class);

    Route::middleware(['permission'])->group(function () {
        // Student Information.
        Route::resource('student_information', StudentInformationController::class);

        // Personal Information.
        Route::resource('personal_information', PersonalInformationController::class);

        // Family Information.
        Route::resource('family_information', FamilyInformationController::class);

        // Education Information.
        Route::resource('education_information', EducationInformationController::class);

        // Dashboard.
        Route::resource('dashboard', DashboardController::class);

        // Student Management.
        Route::resource('student_management', StudentManagementController::class);

        // Teacher Management.
        Route::resource('teacher_management', TeacherManagementController::class);
    });
});
