<?php

namespace App\Services;

use App\Models\VPS;
use App\Models\Rack;
use App\Models\Server;
use App\Models\Subnet;
use App\Models\Customer;
use App\Models\RackSpace;

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
        }

        return $colocation;
    }

    public function getCustomerRelationshipManagerStatistics($user)
    {
        $customer = ['customers' => 0];

        if ($user->hasRole('admin')) {
            $customer['customers'] = Customer::count();
        } else {
            $customer['customers'] = $user->isSubUser()
                ? $user->owner->customers()->count()
                : $user->customers()->count();
        }

        return $customer;
    }

    public function getVpsManagerStatistics($user)
    {
        $vps = ['vps' => 0, 'locations' => []];

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

        return $vps;
    }

    public function getIpManagerStatistics($user)
    {
        $subnet = [
            'subnets' => 0,
            'sub_subnets' => 0,
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

        return $subnet;
    }

    public function getDedicatedServerManagerStatistics($user)
    {
        $server = ['servers' => 0, 'locations' => []];

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

        return $server;
    }
}
