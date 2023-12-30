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
        $this->authorize('view', VPS::class);

        $vpss = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->vpss()
                ->paginate(10)
            : auth()
                ->user()
                ->vpss()
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
        $this->authorize('create', VPS::class);

        $this->validate($request, [
            'hostname' => 'required',
            'ip_address' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'location_id' => 'nullable|integer',
        ]);

        $vps = new VPS();
        $vps->hostname = $request->hostname;
        $vps->ip_address = $request->ip_address;
        $vps->username = $request->username;
        $vps->password = $request->password;
        if ($request->location_id) {
            $vps->location_id = $request->location_id;
        }
        $vps->user_id = auth()
            ->user()
            ->isSubUser()
            ? auth()->user()->owner->id
            : auth()->user()->id;

        $vps->save();

        return redirect()
            ->route('vps_manager.vpss.index')
            ->with('success', 'VPS created successfully');
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
    public function edit(VPS $vpss)
    {
        //
        $vps = $vpss;
        $this->authorize('update', $vps);

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

        return view('vps_manager.vpss.edit', compact('vps', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VPS $vpss)
    {
        //
        $this->validate($request, [
            'hostname' => 'required',
            'ip_address' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'location_id' => 'nullable|integer',
        ]);

        $vps = $vpss;

        $this->authorize('update', $vps);

        $vps->hostname = $request->hostname;
        $vps->ip_address = $request->ip_address;
        $vps->username = $request->username;
        $vps->password = $request->password;

        $vps->location_id = $request->location_id;

        $vps->save();

        return redirect()
            ->route('vps_manager.vpss.index')
            ->with('success', 'VPS updated successfully');
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
        $vps = VPS::findOrFail($id);

        $this->authorize('delete', $vps);

        $vps->delete();

        return redirect()
            ->route('vps_manager.vpss.index')
            ->with('success', 'VPS deleted successfully');
    }
}
