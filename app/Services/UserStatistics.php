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

class UserStatistics
{
    public function getUserStatistics($user)
    {
        $user_statistics = [
            'colocation_manager' => $this->getColocationManaagerStatistics(
                $user
            ),
            'customer_relationship_manager' => $this->getCustomerRelationshipManagerStatistics(
                $user
            ),
            'vps_manager' => $this->getVpsManagerStatistics($user),
            'ip_manager' => $this->getIpManagerStatistics($user),
            'dedicated_server_manager' => $this->getDedicatedServerManagerStatistics(
                $user
            ),
        ];

        return $user_statistics;
    }

    public function getColocationManaagerStatistics($user)
    {
        $colocation = [
            'racks' => 0,
            'rackSpaces' => 0,
            'locations' => [],
            'chart' => [],
        ];

        if ($user->hasRole('admin')) {
            $colocation['racks'] = Rack::count();
            $colocation['rackSpaces'] = RackSpace::count();
        } else {
            $colocation['racks'] = $user->isSubUser()
                ? $user->owner->racks()->count()
                : $user->racks()->count();

            $colocation['rackSpaces'] = $user->isSubUser()
                ? $user->owner
                    ->racks()
                    ->withCount('rackSpaces')
                    ->get()
                    ->sum('rack_spaces_count')
                : $user
                    ->racks()
                    ->withCount('rackSpaces')
                    ->get()
                    ->sum('rack_spaces_count');

            $colocation['locations'] = $user->isSubUser()
                ? $user->owner
                    ->locations()
                    ->where('for', '=', 'colocation')
                    ->with('racks')
                    ->get()
                : $user
                    ->locations()
                    ->where('for', '=', 'colocation')
                    ->with('racks')
                    ->get();

            $colocation['locations']['uncategorized'] = $user->isSubUser()
                ? $user->owner
                    ->racks()
                    ->whereNull('location_id')
                    ->count()
                : $user
                    ->racks()
                    ->whereNull('location_id')
                    ->count();

            $racks_chart = [
                'chart_title' => 'New racks added by days',
                'report_type' => 'group_by_date',
                'model' => 'App\Models\Rack',
                'group_by_field' => 'created_at',
                'group_by_period' => 'day',
                'chart_type' => 'line',
                'chart_color' => '0, 123, 255',
                'conditions' => [
                    [
                        'name' => 'User Racks',
                        'condition' =>
                            'user_id = ' .
                            ($user->isSubUser() ? $user->owner_id : $user->id),
                        'color' => '#007BFF',
                        'fill' => true,
                    ],
                ],
            ];

            $racks_chart = new LaravelChart($racks_chart);

            $colocation['chart'] = $racks_chart;
        }

        return $colocation;
    }

    public function getCustomerRelationshipManagerStatistics($user)
    {
        $customer = ['customers' => 0, 'chart' => []];

        if ($user->hasRole('admin')) {
            $customer['customers'] = Customer::count();
        } else {
            $customer['customers'] = $user->isSubUser()
                ? $user->owner->customers()->count()
                : $user->customers()->count();
        }

        $customers_chart = [
            'chart_title' => 'New customers added by days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Customer',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '0, 123, 255',
            'conditions' => [
                [
                    'name' => 'User Customers',
                    'condition' =>
                        'user_id = ' .
                        ($user->isSubUser() ? $user->owner_id : $user->id),
                    'color' => '#007BFF',
                    'fill' => true,
                ],
            ],
        ];

        $customers_chart = new LaravelChart($customers_chart);

        $customer['chart'] = $customers_chart;

        return $customer;
    }

    public function getVpsManagerStatistics($user)
    {
        $vps = ['vps' => 0, 'locations' => [], 'chart' => []];

        if ($user->hasRole('admin')) {
            $vps['vps'] = VPS::count();
        } else {
            $vps['vps'] = $user->isSubUser()
                ? $user->owner->vpss()->count()
                : $user->vpss()->count();
        }

        $vps['locations'] = $user->isSubUser()
            ? $user->owner
                ->locations()
                ->where('for', '=', 'vps')
                ->with('vpss')
                ->get()
            : $user
                ->locations()
                ->where('for', '=', 'vps')
                ->with('vpss')
                ->get();

        $vps['locations']['uncategorized'] = $user->isSubUser()
            ? $user->owner
                ->vpss()
                ->whereNull('location_id')
                ->count()
            : $user
                ->vpss()
                ->whereNull('location_id')
                ->count();

        $vps_chart = [
            'chart_title' => 'New VPS added by days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\VPS',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '0, 123, 255',
            'conditions' => [
                [
                    'name' => 'User VPS',
                    'condition' =>
                        'user_id = ' .
                        ($user->isSubUser() ? $user->owner_id : $user->id),
                    'color' => '#007BFF',
                    'fill' => true,
                ],
            ],
        ];

        $vps_chart = new LaravelChart($vps_chart);

        $vps['chart'] = $vps_chart;

        return $vps;
    }

    public function getIpManagerStatistics($user)
    {
        $subnet = [
            'subnets' => 0,
            'sub_subnets' => 0,
            'chart' => [],
        ];

        if ($user->hasRole('admin')) {
            $subnet['subnets'] = Subnet::whereNull('parent_id')->count();
            $subnet['sub_subnets'] = Subnet::whereNotNull('parent_id')->count();
        } else {
            $subnet['subnets'] = $user->isSubUser()
                ? $user->owner
                    ->subnets()
                    ->whereNull('parent_id')
                    ->count()
                : $user
                    ->subnets()
                    ->whereNull('parent_id')
                    ->count();

            $subnet['sub_subnets'] = $user->isSubUser()
                ? $user->owner
                    ->subnets()
                    ->whereNotNull('parent_id')
                    ->count()
                : $user
                    ->subnets()
                    ->whereNotNull('parent_id')
                    ->count();
        }

        $subnets_chart = [
            'chart_title' => 'New subnets added by days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Subnet',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '0, 123, 255',
            'conditions' => [
                [
                    'name' => 'User Subnets',
                    'condition' =>
                        'user_id = ' .
                        ($user->isSubUser() ? $user->owner_id : $user->id),
                    'color' => '#007BFF',
                    'fill' => true,
                ],
            ],
        ];

        $subnets_chart = new LaravelChart($subnets_chart);

        $subnet['chart'] = $subnets_chart;

        return $subnet;
    }

    public function getDedicatedServerManagerStatistics($user)
    {
        $server = ['servers' => 0, 'locations' => [], 'chart' => []];

        if ($user->hasRole('admin')) {
            $server['servers'] = Server::count();
        } else {
            $server['servers'] = $user->isSubUser()
                ? $user->owner->servers()->count()
                : $user->servers()->count();
        }

        $server['locations'] = $user->isSubUser()
            ? $user->owner
                ->locations()
                ->where('for', '=', 'server')
                ->with('servers')
                ->get()
            : $user
                ->locations()
                ->where('for', '=', 'server')
                ->with('servers')
                ->get();

        $server['locations']['uncategorized'] = $user->isSubUser()
            ? $user->owner
                ->servers()
                ->whereNull('location_id')
                ->count()
            : $user
                ->servers()
                ->whereNull('location_id')
                ->count();

        $servers_chart = [
            'chart_title' => 'New servers added by days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Server',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '0, 123, 255',
            'conditions' => [
                [
                    'name' => 'User Servers',
                    'condition' =>
                        'user_id = ' .
                        ($user->isSubUser() ? $user->owner_id : $user->id),
                    'color' => '#007BFF',
                    'fill' => true,
                ],
            ],
        ];

        $servers_chart = new LaravelChart($servers_chart);

        $server['chart'] = $servers_chart;

        return $server;
    }
}
