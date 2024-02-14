<?php

namespace App\Services;

use App\Models\VPS;
use App\Models\Rack;
use App\Models\User;
use App\Models\Server;
use App\Models\Subnet;
use App\Models\Customer;
use App\Models\Location;
use App\Models\RackSpace;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminStatistics
{
    public function getAdminStatistics()
    {
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

        $statistics = [
            'users' => ['count' => User::count(), 'chart' => []],
            'locations' => [
                'count' => Location::count(),
                'chart' => $locations_chart,
            ],
            'racks' => ['count' => Rack::count(), 'chart' => $racks_chart],
            'rackSpaces' => ['count' => RackSpace::count(), 'chart' => []],
            'customers' => [
                'count' => Customer::count(),
                'chart' => $customers_chart,
            ],
            'vpss' => ['count' => VPS::count(), 'chart' => $vpss_chart],
            'subnets' => [
                'count' => Subnet::whereNull('parent_id')->count(),
                'chart' => $subnets_chart,
            ],
            'servers' => [
                'count' => Server::count(),
                'chart' => $servers_chart,
            ],
            'sub_subnets' => [
                'count' => Subnet::whereNotNull('parent_id')->count(),
                'chart' => [],
            ],
        ];

        return $statistics;
    }
}
