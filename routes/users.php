<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin|user'])->group(function () {
    Route::resource('users', UserController::class);

    Route::get('search-user', [UserController::class, 'search'])->name(
        'users.search'
    );
});
