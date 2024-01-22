<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Colocation Manager
        'App\Models\Location' => 'App\Policies\LocationPolicy',
        'App\Models\Rack' => 'App\Policies\Colocation_Manager\RackPolicy',
        // Customer relationship manager
        'App\Models\Customer' =>
            'App\Policies\Customer_Relationship_Manager\CustomerPolicy',
        // VPS Manager
        'App\Models\VPS' => 'App\Policies\Vps_Manager\VpsPolicy',
        // IP Manager
        'App\Models\Subnet' => 'App\Policies\Ip_Manager\SubnetPolicy',
        // Dedicated Server Manager
        'App\Models\Server' =>
            'App\Policies\Dedicated_Server_Manager\ServerPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-modules', function ($user, $moduleName) {
            if ($user->hasRole('admin')) {
                return true;
            }

            return $user->hasRole($moduleName);
        });
    }
}
