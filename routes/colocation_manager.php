<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Colocation_Manager\RackController;
use App\Http\Controllers\Colocation_Manager\LocationController;

/*
|--------------------------------------------------------------------------
| Rack Routes
|--------------------------------------------------------------------------
*/

Route::prefix('colocation_manager')
    ->name('colocation_manager.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('locations', LocationController::class);
        Route::resource('racks', RackController::class);

        Route::get('/racks/{rack}/spaces/{unit_number}', [
            RackController::class,
            'spaces',
        ])->name('racks.spaces.show');

        Route::patch('/racks/{rack}/spaces/{unit_number}', [
            RackController::class,
            'spaces_update',
        ])->name('racks.spaces.update');
    });
