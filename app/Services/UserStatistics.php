<?php

namespace App\Services;

use App\Models\Rack;
use App\Models\RackSpace;

class UserStatistics
{
    public function getUserStatistics($user)
    {
        $user_statistics = [
            'colocation_manager' => $this->getColocationManaagerStatistics(
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
                    ->with('racks')
                    ->get()
                : $user
                    ->locations()
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
}
