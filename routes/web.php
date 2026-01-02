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
    
    // Dashboard - Accessible by Ketua, Admin Data, Anggota
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:ketua,admin-data,anggota')
        ->name('dashboard');
    
    // Master Data Management Routes will be added here
    // Activity Management Routes will be added here
    // Content Management Routes will be added here
});

// Authentication Routes (Laravel Breeze)
require __DIR__.'/auth.php';
