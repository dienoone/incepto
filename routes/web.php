<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\RouteHelper;

Route::get('/', function () {
    return view('playground');
});

Route::get('/home', function () {
    return view('pages.public.home');
})->name('home');



Route::get('/seeker', function () {
    return view('pages.seeker.dashboard');
});


Route::get('/employer', function () {
    return view('pages.employer.dashboard');
});


RouteHelper::includeRouteFiles(__DIR__ . '/Web');

Route::get('/ping', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is running',
        'data' => ['version', '1.0.0']
    ]);
});
