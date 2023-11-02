<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackSpace;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $racks = 0;
        $rackSpaces = 0;
        $users = 0;
        $locations = [];

        if ($user->hasRole('admin')) {
            $racks = Rack::count();
            $rackSpaces = RackSpace::count();
            $users = User::count();
        } else {
            $query = Rack::where(
                'user_id',
                $user->isSubUser() ? $user->owner->id : $user->id
            );

            $racks = $query->count();
            $rackSpaces = $query
                ->withCount('rackSpaces')
                ->get()
                ->sum('rack_spaces_count');

            $locations = $user->isSubUser()
                ? $user->owner
                    ->locations()
                    ->with('racks')
                    ->get()
                : $user
                    ->locations()
                    ->with('racks')
                    ->get();
        }

        return view(
            'dashboard',
            compact('racks', 'rackSpaces', 'users', 'locations')
        );
    }
}
