<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{HomeController, PublicController};
use App\Http\Controllers\CMS\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/about', [PublicController::class, 'about'])->name('about');

// Activities
Route::get('/activities', [PublicController::class, 'activities'])->name('activities');

// News
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/news/{slug}', [PublicController::class, 'newsDetail'])->name('news.detail');

// Documentation
Route::get('/documentation', [PublicController::class, 'documentation'])->name('documentation');

// CMS Routes - Protected by auth and role middleware
Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    
    // Dashboard - Accessible by all authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:ketua,admin-data,anggota')
        ->name('dashboard');
    
    // Users Management - Ketua and Admin only
    Route::middleware('role:ketua,admin-data')->group(function () {
        Route::resource('users', \App\Http\Controllers\CMS\UserController::class);
    });
    
    // Categories Management - Ketua and Admin only
    Route::middleware('role:ketua,admin-data')->group(function () {
        Route::resource('categories', \App\Http\Controllers\CMS\CategoryController::class);
    });
    
    // News/Content Management - All roles
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::resource('news', \App\Http\Controllers\CMS\NewsController::class);
    });
    
    // Activity Plans - All roles  
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::post('activity-plans/{activityPlan}/submit-for-review', [\App\Http\Controllers\CMS\ActivityPlanController::class, 'submitForReview'])
            ->name('activity-plans.submit-for-review');
        Route::resource('activity-plans', \App\Http\Controllers\CMS\ActivityPlanController::class);
    });

    // Activity Plans Approval - Ketua only
    Route::middleware('role:ketua')->group(function () {
        Route::post('activity-plans/{activityPlan}/approve', [\App\Http\Controllers\CMS\ActivityPlanController::class, 'approve'])
            ->name('activity-plans.approve');
        Route::post('activity-plans/{activityPlan}/reject', [\App\Http\Controllers\CMS\ActivityPlanController::class, 'reject'])
            ->name('activity-plans.reject');
    });
    
    // Activity Realizations - All roles
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::delete('documentation/{documentation}', [\App\Http\Controllers\CMS\ActivityRealizationController::class, 'deleteEvidence'])
            ->name('documentation.destroy');
        Route::resource('activity-realizations', \App\Http\Controllers\CMS\ActivityRealizationController::class);
    });
    
    
    // Documentation - All roles
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::resource('documentation', \App\Http\Controllers\CMS\DocumentationController::class);
    });

    // Financial Transactions - All roles
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::resource('financial-transactions', \App\Http\Controllers\CMS\FinancialTransactionController::class);
    });

    // Meetings - All roles
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::post('meetings/{meeting}/complete', [\App\Http\Controllers\CMS\MeetingController::class, 'complete'])
            ->name('meetings.complete');
        Route::resource('meetings', \App\Http\Controllers\CMS\MeetingController::class);
    });

    // Documents Repository - All roles
    Route::middleware('role:ketua,admin-data,anggota')->group(function () {
        Route::get('documents/{document}/download', [\App\Http\Controllers\CMS\DocumentController::class, 'download'])
            ->name('documents.download');
        Route::resource('documents', \App\Http\Controllers\CMS\DocumentController::class);
    });
});

// Authentication Routes (Laravel Breeze)
require __DIR__.'/auth.php';
