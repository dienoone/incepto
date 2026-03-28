<?php

use App\Http\Controllers\Web\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs',       [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
