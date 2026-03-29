<?php

use App\Http\Controllers\Web\Seeker\DashboardController;
use App\Http\Controllers\Web\Seeker\ProfileController;
use App\Http\Controllers\Web\Seeker\SavedJobController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:seeker'])
    ->prefix('dashboard')
    ->name('seeker.')
    ->group(function () {

        Route::get('/applications', [DashboardController::class, 'applications'])->name('applications');

        Route::get('/saved',            [SavedJobController::class, 'index'])->name('saved');
        Route::post('/bookmark',            [SavedJobController::class, 'store'])->name('bookmark.store');
        Route::delete('/saved/{jobId}', [SavedJobController::class, 'destroy'])->name('saved.destroy');

        Route::get('/profile',   [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile',   [ProfileController::class, 'update'])->name('profile.update');

        Route::post('/skills', [ProfileController::class, 'syncSkills'])->name('skills.sync');

        Route::post('/experience',        [ProfileController::class, 'addExperience'])->name('experience.store');
        Route::delete('/experience/{id}', [ProfileController::class, 'deleteExperience'])->name('experience.destroy');

        Route::post('/education',        [ProfileController::class, 'addEducation'])->name('education.store');
        Route::delete('/education/{id}', [ProfileController::class, 'deleteEducation'])->name('education.destroy');

        Route::post('/attachments',        [ProfileController::class, 'addAttachment'])->name('attachments.store');
        Route::delete('/attachments/{id}', [ProfileController::class, 'deleteAttachment'])->name('attachments.destroy');
    });
