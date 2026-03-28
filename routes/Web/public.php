<?php

use App\Http\Controllers\Web\JobController;
use App\Http\Controllers\Web\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs',       [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/companies',        [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{slug}', [CompanyController::class, 'show'])->name('companies.show');
