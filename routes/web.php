<?php

use App\Http\Controllers\Apprenticeship\ApprenticeshipController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Campus\CampusInformationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\JobVacancy\JobVacancyController;
use App\Http\Controllers\Master\FacultyController;
use App\Http\Controllers\Master\StudyProgramController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;
use App\Http\Controllers\TracerStudy\TracerStudyController;
use App\Http\Controllers\User\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('auth.index');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Authenticated users only
    Route::middleware('frontend.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware('frontend.auth')->group(function () {
    // Home / Dashboard
    Route::prefix('dashboard')->name('dashboard.')
        ->middleware(['role:admin,super_admin'])
        ->group(function () {
            
        Route::get('/index', [DashboardController::class, 'index'])->name('index');
    });
    
    // Super Admin
    Route::prefix('admins')->name('admins.')
        ->middleware(['role:super_admin'])
        ->group(function () {
            
        Route::get('/index', [AdminManagementController::class, 'index'])->name('index');
        Route::get('/create', [AdminManagementController::class, 'create'])->name('create');
        Route::post('/store', [AdminManagementController::class, 'store'])->name('store');

        Route::get('/{id}/edit', [AdminManagementController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminManagementController::class, 'update'])->name('update');

        Route::get('/{id}', [AdminManagementController::class, 'show'])->name('show');
    });
    
    // Users 
    Route::prefix('users')->name('users.')
        ->middleware(['role:admin,super_admin'])
        ->group(function () {
            
        Route::get('/users', [UserManagementController::class, 'index'])->name('index');
        Route::get('/create', [UserManagementController::class, 'create'])->name('create');
        Route::post('/store', [UserManagementController::class, 'store'])->name('store');

        Route::put('/{id}/approve', [UserManagementController::class, 'approve'])->name('approve');
        Route::put('/{id}/reject', [UserManagementController::class, 'reject'])->name('reject');
        
        Route::get('/{id}', [UserManagementController::class, 'show'])->name('show');
    });
    
    // Tracer Study 
    Route::prefix('tracer-study')->name('tracer-study.')
        ->middleware(['role:super_admin'])
        ->group(function () {
            
        Route::get('/index', [TracerStudyController::class, 'index'])->name('index');
        Route::get('/export', [TracerStudyController::class, 'export'])->name('export');
        Route::get('/{id}', [TracerStudyController::class, 'show'])->name('show');
    });
    
    // Job Vacancy 
    Route::prefix('jobvacancy')->name('jobvacancy.')
        ->middleware(['role:admin'])
        ->group(function () {
            
        Route::get('/index', [JobVacancyController::class, 'index'])->name('index');

        Route::put('/{id}/approve', [JobVacancyController::class, 'approve'])->name('approve');
        Route::put('/{id}/reject', [JobVacancyController::class, 'reject'])->name('reject');
        Route::put('/{id}/end', [JobVacancyController::class, 'end'])->name('end');

        Route::get('/{id}', [JobVacancyController::class, 'show'])->name('show');
    });
    
    // Apprenticeship 
    Route::prefix('apprenticeship')->name('apprenticeship.')
        ->middleware(['role:admin'])
        ->group(function () {
            
        Route::get('/index', [ApprenticeshipController::class, 'index'])->name('index');

        Route::put('/{id}/approve', [ApprenticeshipController::class, 'approve'])->name('approve');
        Route::put('/{id}/reject', [ApprenticeshipController::class, 'reject'])->name('reject');
        Route::put('/{id}/end', [ApprenticeshipController::class, 'end'])->name('end');
        
        Route::get('/{id}', [ApprenticeshipController::class, 'show'])->name('show');
    });
    
    // Campus Info 
    Route::prefix('campus-info')->name('campus-info.')
        ->middleware(['role:admin,super_admin'])
        ->group(function () {
            
        Route::get('/index', [CampusInformationController::class, 'index'])->name('index');
        Route::get('/create', [CampusInformationController::class, 'create'])->name('create');
        Route::post('/store', [CampusInformationController::class, 'store'])->name('store');
        
        Route::get('/{id}/edit', [CampusInformationController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CampusInformationController::class, 'update'])->name('update');
        Route::put('/{id}/end', [CampusInformationController::class, 'end'])->name('end');

        Route::get('/{id}', [CampusInformationController::class, 'show'])->name('show');
    });
    
    // Master (Faculty and Study Program) 
    Route::prefix('master')->name('master.')
        ->middleware(['role:super_admin'])
        ->group(function () {

        Route::prefix('faculties')->name('faculties.')->group(function () {
            Route::get('/index', [FacultyController::class, 'index'])->name('index');
            Route::get('/create', [FacultyController::class, 'create'])->name('create');
            Route::post('/store', [FacultyController::class, 'store'])->name('store');
            Route::delete('/{id}/delete', [FacultyController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/edit', [FacultyController::class, 'edit'])->name('edit');
            Route::put('/{id}', [FacultyController::class, 'update'])->name('update');
        });

        Route::prefix('study-programs')->name('study-programs.')->group(function () {
            Route::get('/', [StudyProgramController::class, 'index'])->name('index');
            Route::get('/create', [StudyProgramController::class, 'create'])->name('create');
            Route::post('/', [StudyProgramController::class, 'store'])->name('store');
            Route::delete('/{id}/delete', [StudyProgramController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/edit', [StudyProgramController::class, 'edit'])->name('edit');
            Route::put('/{id}', [StudyProgramController::class, 'update'])->name('update');
        });
    });
});
