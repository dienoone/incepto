<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\RouteHelper;




RouteHelper::includeRouteFiles(__DIR__ . '/Web');

Route::get('/ping', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is running',
        'data' => ['version', '1.0.0']
    ]);
});
