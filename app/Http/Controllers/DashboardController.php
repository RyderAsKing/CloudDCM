<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\RackSpace;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $racks = [];
        $rackSpaces = [];

        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            $racks = Rack::all()->count();
            $rackSpaces = RackSpace::all()->count();
        } elseif (
            auth()
                ->user()
                ->isSubUser()
        ) {
            $racks = Rack::where('user_id', auth()->user()->owner->id)->count();
            $rackSpaces = RackSpace::where(
                'user_id',
                auth()->user()->owner->id
            )->count();
        } else {
            $racks = Rack::where('user_id', auth()->user()->id)->count();
            $rackSpaces = RackSpace::where(
                'user_id',
                auth()->user()->id
            )->count();
        }

        return view('dashboard', compact('racks', 'rackSpaces'));
    }
}
