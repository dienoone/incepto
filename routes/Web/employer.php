<?php

use App\Http\Controllers\Web\Employer\DashboardController;
use App\Http\Controllers\Web\Employer\JobController;
use App\Http\Controllers\Web\Employer\ApplicationController;
use App\Http\Controllers\Web\Employer\TeamController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:company'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Jobs
        Route::get('/jobs/create',        [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs',              [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{id}/edit',     [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{id}',          [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{id}',       [JobController::class, 'destroy'])->name('jobs.destroy');
        Route::post('/jobs/{id}/toggle',  [JobController::class, 'toggle'])->name('jobs.toggle');

        // Applicants
        Route::get('/applicants',               [ApplicationController::class, 'index'])->name('applicants');
        Route::get('/applicants/{id}',          [ApplicationController::class, 'show'])->name('applicants.show');
        Route::patch('/applicants/{id}/status', [ApplicationController::class, 'updateStatus'])->name('applicants.status');

        // Teams
        Route::get('/teams',                              [TeamController::class, 'index'])->name('teams');
        Route::post('/teams',                             [TeamController::class, 'store'])->name('teams.store');
        Route::delete('/teams/{id}',                      [TeamController::class, 'destroy'])->name('teams.destroy');
        Route::post('/teams/{teamId}/members',            [TeamController::class, 'addMember'])->name('teams.members.store');
        Route::delete('/teams/{teamId}/members/{memberId}', [TeamController::class, 'removeMember'])->name('teams.members.destroy');
    });
