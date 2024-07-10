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
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    Route::middleware(['student'])->group(function () {
        // Student Information.
        Route::get('student_information', [StudentInformationController::class, 'index'])->name('student_information');

        // Personal Information.
        Route::get('personal_information', [PersonalInformationController::class, 'index'])->name('personal_information');
        
        // Family Information.
        Route::get('family_information', [FamilyInformationController::class, 'index'])->name('family_information');
        
        // Education Information.
        Route::get('education_information', [EducationInformationController::class, 'index'])->name('education_information');
    });

    Route::middleware(['teacher'])->group(function () {
        // Dashboard.
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Student Management.
        Route::get('student_management', [StudentManagementController::class, 'index'])->name('student_management');
    });
});
