<?php

namespace App\Http\Controllers;

use App\Models\User;
use Qirolab\Theme\Theme;
use App\Services\UserStatistics;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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
        $admin_statistics = $this->userStatistics->getAdminStatistics($user);

        if ($user->hasRole('admin')) {
            $users = User::count();
            $locations_chart = [
                'chart_title' => 'New locations added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Location',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'line',
                'chart_color' => '0, 123, 255',
                'filter_period ' => 'week',
            ];

            $racks_chart = [
                'chart_title' => 'New racks added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Rack',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'bar',
                'chart_color' => '0, 123, 255',
            ];

            $customers_chart = [
                'chart_title' => 'New customers added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Customer',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'line',
                'chart_color' => '0, 123, 255',
            ];

            $vpss_chart = [
                'chart_title' => 'New VPS added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Vps',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'line',
                'chart_color' => '0, 123, 255',
            ];

            $subnets_chart = [
                'chart_title' => 'New subnets added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Subnet',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'line',
                'chart_color' => '0, 123, 255',
            ];

            $servers_chart = [
                'chart_title' => 'New servers added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Server',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'line',
                'chart_color' => '0, 123, 255',
            ];

            $racks_chart = new LaravelChart($racks_chart);
            $locations_chart = new LaravelChart($locations_chart);
            $customers_chart = new LaravelChart($customers_chart);
            $vpss_chart = new LaravelChart($vpss_chart);
            $subnets_chart = new LaravelChart($subnets_chart);
            $servers_chart = new LaravelChart($servers_chart);

            $charts = [
                'racks_chart' => $racks_chart,
                'locations_chart' => $locations_chart,
                'customers_chart' => $customers_chart,
                'vpss_chart' => $vpss_chart,
                'subnets_chart' => $subnets_chart,
                'servers_chart' => $servers_chart,
            ];

            return view('admin', [
                'users' => $users,
                'colocation_manager' => $user_statistics['colocation_manager'],
                'customer_relationship_manager' =>
                    $user_statistics['customer_relationship_manager'],
                'vps_manager' => $user_statistics['vps_manager'],
                'ip_manager' => $user_statistics['ip_manager'],
                'dedicated_server_manager' =>
                    $user_statistics['dedicated_server_manager'],
                'charts' => $charts,
                'admin_statistics' => $admin_statistics,
            ]);
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
