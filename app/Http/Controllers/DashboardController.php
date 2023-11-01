<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackSpace;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $racks = [];
        $rackSpaces = [];
        $users = [];

        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            $racks = Rack::all()->count();
            $rackSpaces = RackSpace::all()->count();
            $users = User::all()->count();
        } elseif (
            auth()
                ->user()
                ->isSubUser()
        ) {
            $racks = Rack::where('user_id', auth()->user()->owner->id)->count();
            $rackSpaces = auth()
                ->user()
                ->owner->racks()
                ->withCount('rackSpaces')
                ->get()
                ->sum('rack_spaces_count');
        } else {
            $racks = Rack::where('user_id', auth()->user()->id)->count();
            $rackSpaces = auth()
                ->user()
                ->racks()
                ->withCount('rackSpaces')
                ->get()
                ->sum('rack_spaces_count');
        }

        return view('dashboard', compact('racks', 'rackSpaces', 'users'));
    }
}
