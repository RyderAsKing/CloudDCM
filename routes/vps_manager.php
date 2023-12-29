<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vps_Manager\VpsController;
use App\Http\Controllers\Vps_Manager\LocationController;

/*
|--------------------------------------------------------------------------
| Rack Routes
|--------------------------------------------------------------------------
*/

Route::prefix('vps_manager')
    ->name('vps_manager.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('locations', LocationController::class);
        Route::resource('vpss', VpsController::class);
    });
