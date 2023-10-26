<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RackController;

/*
|--------------------------------------------------------------------------
| Rack Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
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
