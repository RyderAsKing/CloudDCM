<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin|user'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('users/search', [UserController::class, 'search'])->name(
        'users.search'
    );
});
