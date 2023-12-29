<?php

namespace App\Http\Controllers\Vps_Manager;

use App\Models\VPS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('he');
        $this->authorize('view', VPS::class);

        $vpss = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->vpss()
                ->where('location_id', '=', null)
                ->paginate(10)
            : auth()
                ->user()
                ->vpss()
                ->where('location_id', '=', null)
                ->paginate(10);

        return view('vps_manager.vpss.index', compact('vpss'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', VPS::class);

        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'vps')
                ->get()
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'vps')
                ->get();
        return view('vps_manager.vpss.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
