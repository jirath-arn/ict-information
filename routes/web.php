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
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('profile/password', [ProfileController::class, 'update'])->name('profile.update');

    // Permission.
    Route::middleware(['permission'])->group(function () {
        // Student Information.
        Route::get('student_information', [StudentInformationController::class, 'index'])->name('student_information.index');

        // Personal Information.
        Route::get('personal_information', [PersonalInformationController::class, 'index'])->name('personal_information.index');
        Route::get('personal_information/edit', [PersonalInformationController::class, 'edit'])->name('personal_information.edit');
        Route::post('personal_information/update', [PersonalInformationController::class, 'update'])->name('personal_information.update');

        // Family Information.
        Route::get('family_information', [FamilyInformationController::class, 'index'])->name('family_information.index');
        Route::get('family_information/edit', [FamilyInformationController::class, 'edit'])->name('family_information.edit');
        Route::post('family_information/update', [FamilyInformationController::class, 'update'])->name('family_information.update');

        // Education Information.
        Route::get('education_information', [EducationInformationController::class, 'index'])->name('education_information.index');
        Route::get('education_information/edit', [EducationInformationController::class, 'edit'])->name('education_information.edit');
        Route::post('education_information/update', [EducationInformationController::class, 'update'])->name('education_information.update');

        // Dashboard.
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Student Management.
        Route::get('student_management', [StudentManagementController::class, 'index'])->name('student_management.index');
        Route::delete('student_management/{id}', [StudentManagementController::class, 'destroy'])->name('student_management.destroy');

        // Teacher Management.
        Route::get('teacher_management', [TeacherManagementController::class, 'index'])->name('teacher_management.index');
    });
});
