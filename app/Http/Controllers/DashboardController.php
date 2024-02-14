<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AdminStatistics;
use Qirolab\Theme\Theme;
use App\Services\UserStatistics;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    protected $userStatistics;

    public function __construct(
        UserStatistics $userStatistics,
        AdminStatistics $adminStatistics
    ) {
        $this->userStatistics = $userStatistics;
        $this->adminStatistics = $adminStatistics;
    }

    public function index()
    {
        $user = auth()->user();
        $users = 0;
        $user_statistics = $this->userStatistics->getUserStatistics($user);

        if ($user->hasRole('admin')) {
            $admin_statistics = $this->adminStatistics->getAdminStatistics();
            $users = $admin_statistics['users']['count'];
        }

        return view($user->hasRole('admin') ? 'admin' : 'dashboard', [
            'users' => $users,
            'colocation_manager' => $user_statistics['colocation_manager'],
            'customer_relationship_manager' =>
                $user_statistics['customer_relationship_manager'],
            'vps_manager' => $user_statistics['vps_manager'],
            'ip_manager' => $user_statistics['ip_manager'],
            'dedicated_server_manager' =>
                $user_statistics['dedicated_server_manager'],
            'admin_statistics' => $user->hasRole('admin')
                ? $admin_statistics
                : null,
        ]);
    }
}
