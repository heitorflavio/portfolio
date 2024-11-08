<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VisitController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::group(['middleware' => SetLocale::class], function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/visits', VisitController::class)->name('visits');

        Route::resource('projects', ProjectController::class);
        Route::resource('skills', SkillController::class);
    });
});
