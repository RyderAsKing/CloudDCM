<?php

namespace App\Http\Controllers\Vps_Manager;

use App\Models\VPS;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('view', [Location::class, 'vps']);

        //
        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'vps')
                ->paginate(10)
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'vps')
                ->paginate(10);

        // check if there is any rack which is not assigned to any location and add it to the locations array as $location['uncategorized']
        $locations['uncategorized'] = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->vpss()
                ->where('location_id', null)
                ->count()
            : auth()
                ->user()
                ->vpss()
                ->where('location_id', null)
                ->count();

        return view('vps_manager.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', [Location::class, 'vps']);

        return view('vps_manager.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Location::class, 'vps']);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $location = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->create($request->all())
            : auth()
                ->user()
                ->locations()
                ->create($request->all());

        $location->for = 'vps';

        $location->save();

        return redirect()
            ->route('vps_manager.locations.index')
            ->with('success', 'Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);
        $this->authorize('show', [$location, 'vps']);

        $vpss = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->vpss()
                ->where('location_id', '=', $id)
                ->paginate(10)
            : auth()
                ->user()
                ->vpss()
                ->where('location_id', '=', $id)
                ->paginate(10);

        return view('vps_manager.vpss.index', compact('vpss'));
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
        $location = Location::findOrFail($id);

        $this->authorize('update', [$location, 'vps']);

        return view('vps_manager.locations.edit', compact('location'));
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

        $location = Location::findOrFail($id);

        $this->authorize('update', [$location, 'vps']);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $location->update($request->all());

        return redirect()
            ->route('vps_manager.locations.index')
            ->with('success', 'Location updated successfully');
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
        $location = Location::findOrFail($id);

        $this->authorize('delete', [$location, 'vps']);

        $vpss = VPS::where('location_id', $id)->get();

        foreach ($vpss as $vps) {
            $vps->location_id = null;
            $vps->save();
        }

        $location->delete();
        return redirect()
            ->route('vps_manager.locations.index')
            ->with('success', 'Location deleted successfully');
    }
}
