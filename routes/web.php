<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('playground');
});

Route::get('/home', function () {
    return view('pages.public.home');
});

Route::get('/seeker', function () {
    return view('pages.seeker.dashboard');
});


Route::get('/employer', function () {
    return view('pages.employer.dashboard');
});
