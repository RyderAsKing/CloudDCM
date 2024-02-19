<?php

namespace App\Providers;

use Qirolab\Theme\Theme;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // check if theme is set to ryd = tailwind, else use bootstrap
        if (Theme::active() == 'ryd') {
            Paginator::defaultView('vendor.pagination.tailwind');
        } else {
            Paginator::defaultView('vendor.pagination.bootstrap-5');
        }
    }
}
