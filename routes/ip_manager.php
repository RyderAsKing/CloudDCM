<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IpManager\IpsController;
use App\Http\Controllers\Ip_Manager\SubnetController;

Route::prefix('ip_manager')
    ->name('ip_manager.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('subnets', SubnetController::class);
        Route::post('subnets/{subnet}/range', [
            SubnetController::class,
            'range',
        ])->name('subnets.range');

        Route::resource('ips', IpsController::class);
    });
