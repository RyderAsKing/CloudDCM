<?php

namespace App\Http\Controllers;

use App\Models\User;
use Qirolab\Theme\Theme;
use App\Services\UserStatistics;

class DashboardController extends Controller
{
    protected $userStatistics;

    public function __construct(UserStatistics $userStatistics)
    {
        $this->userStatistics = $userStatistics;
    }

    public function index()
    {
        $user = auth()->user();
        $users = 0;
        $user_statistics = $this->userStatistics->getUserStatistics($user);

        if ($user->hasRole('admin')) {
            $users = User::count();
        }

        return view('dashboard', [
            'users' => $users,
            'colocation_manager' => $user_statistics['colocation_manager'],
            'customer_relationship_manager' =>
                $user_statistics['customer_relationship_manager'],
            'vps_manager' => $user_statistics['vps_manager'],
            'ip_manager' => $user_statistics['ip_manager'],
            'dedicated_server_manager' =>
                $user_statistics['dedicated_server_manager'],
        ]);
    }
}
