<?php

namespace App\Http\Controllers\Ip_Manager;

use App\Models\Subnet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('view', Subnet::class);

        $subnets = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->subnets()
                ->paginate(10)
            : auth()
                ->user()
                ->subnets()
                ->paginate(10);

        return view('ip_manager.subnets.index', compact('subnets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', Subnet::class);

        return view('ip_manager.subnets.create');
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
        $this->authorize('create', Subnet::class);

        dd('SubnetController@store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subnet $subnet)
    {
        //
        $this->authorize('show', $subnet);

        dd('SubnetController@show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subnet $subnet)
    {
        //
        $this->authorize('update', $subnet);

        dd('SubnetController@edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subnet $subnet)
    {
        //
        $this->authorize('update', $subnet);

        dd('SubnetController@update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subnet $subnet)
    {
        //
        $this->authorize('delete', $subnet);

        dd('SubnetController@destroy');
    }
}
