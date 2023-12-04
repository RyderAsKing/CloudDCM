<?php

use Illuminate\Support\Facades\Route;

Route::prefix('customer_relationship_manager')
    ->name('customer_relationship_manager.')
    ->middleware('auth')
    ->group(function () {});
