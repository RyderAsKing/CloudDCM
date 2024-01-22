<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dedicated_Server_Manager\ServerController;
use App\Http\Controllers\Dedicated_Server_Manager\LocationController;

/*
|--------------------------------------------------------------------------
| Rack Routes
|--------------------------------------------------------------------------
*/

Route::prefix('dedicated_server_manager')
    ->name('dedicated_server_manager.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('locations', LocationController::class);
        Route::resource('servers', ServerController::class);
    });
