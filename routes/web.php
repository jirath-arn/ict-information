<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CRUDs\DashboardController;
use App\Http\Controllers\CRUDs\StudentInformationController;

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

    Route::middleware(['student'])->group(function () {
        // Student Information.
        Route::get('student_information', [StudentInformationController::class, 'index'])->name('student_information');
    });

    Route::middleware(['teacher'])->group(function () {
        // Dashboard.
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});
