<?php

namespace App\Http\Controllers\Colocation_Manager;

use App\Models\Rack;
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
        $this->authorize('view', [Location::class, 'colocation']);

        //
        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'colocation')
                ->paginate(10)
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'colocation')
                ->paginate(10);

        // check if there is any rack which is not assigned to any location and add it to the locations array as $location['uncategorized']
        $locations['uncategorized'] = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->racks()
                ->where('location_id', null)
                ->count()
            : auth()
                ->user()
                ->racks()
                ->where('location_id', null)
                ->count();

        return view('colocation_manager.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', [Location::class, 'colocation']);

        return view('colocation_manager.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Location::class, 'colocation']);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
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

        $location->for = 'colocation';

        $location->save();

        return redirect()
            ->route('colocation_manager.locations.index')
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
        $this->authorize('show', [$location, 'colocation']);

        $racks = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->racks()
                ->where('location_id', $id)
                ->withCount('rackSpaces')
                ->with([
                    'rackSpaces' => function ($query) {
                        $query->where('name', '!=', null);
                    },
                ])
                ->paginate(10)
            : auth()
                ->user()
                ->racks()
                ->where('location_id', $id)
                ->withCount('rackSpaces')
                ->with([
                    'rackSpaces' => function ($query) {
                        $query->where('name', '!=', null);
                    },
                ])
                ->paginate(10);

        return view('colocation_manager.racks.index', compact('racks'));
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

        $this->authorize('update', [$location, 'colocation']);

        return view('colocation_manager.locations.edit', compact('location'));
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

        $this->authorize('update', [$location, 'colocation']);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $location->update($request->all());

        return redirect()
            ->route('colocation_manager.locations.index')
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

        $this->authorize('delete', [$location, 'colocation']);

        $racks = Rack::where('location_id', $id)->get();

        foreach ($racks as $rack) {
            $rack->location_id = null;
            $rack->save();
        }

        $location->delete();
        return redirect()
            ->route('colocation_manager.locations.index')
            ->with('success', 'Location deleted successfully');
    }
}
