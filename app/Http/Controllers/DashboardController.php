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
        $racks = Rack::all()->count();
        $rackSpaces = RackSpace::all()->count();
        return view('dashboard', compact('racks', 'rackSpaces'));
    }
}
