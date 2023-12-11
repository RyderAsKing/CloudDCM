<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer_Relationship_Manager\CustomerController;

Route::prefix('customer_relationship_manager')
    ->name('customer_relationship_manager.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('customers', CustomerController::class);
    });
