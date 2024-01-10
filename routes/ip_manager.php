<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ip_Manager\SubnetController;

Route::prefix('ip_manager')
    ->name('ip_manager.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('subnets', SubnetController::class);
    });
