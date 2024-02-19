<?php

namespace App\Http\Controllers\Colocation_Manager;

use App\Http\Controllers\Controller;
use App\Models\Rack;
use App\Policies\Colocation_Manager\RackPolicy;
use App\Models\RackSpace;
use Illuminate\Http\Request;

class RackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Rack::class);

        $racks = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->racks()
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Rack::class);

        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'colocation')
                ->get()
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'colocation')
                ->get();
        return view('colocation_manager.racks.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Rack::class);

        $request->validate([
            'name' => 'required|unique:racks|max:255',
            'description' => 'required',
            'rack_size' => 'numeric|required|min:1|max:256',
            'location' => 'numeric|nullable',
        ]);

        $rack = new Rack();

        $rack->name = $request->name;
        $rack->description = $request->description;
        $rack->user_id = auth()
            ->user()
            ->isSubUser()
            ? auth()->user()->owner->id
            : auth()->user()->id;

        if ($request->location) {
            $rack->location_id = $request->location;
        }

        $rack->save();

        for ($i = 1; $i <= $request->rack_size; $i++) {
            RackSpace::create([
                'rack_id' => $rack->id,
                'unit_number' => $i,
            ]);
        }

        return redirect()
            ->route('colocation_manager.racks.index')
            ->with('success', 'Rack has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('show', $rack, Rack::class);

        return view('colocation_manager.racks.show', compact('rack'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'colocation')
                ->get()
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'colocation')
                ->get();

        return view(
            'colocation_manager.racks.edit',
            compact('rack', 'locations')
        );
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
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'location' => 'numeric|nullable',
        ]);

        $rack->name = $request->name;
        $rack->description = $request->description;

        if ($request->location) {
            $rack->location_id = $request->location;
        } else {
            $rack->location_id = null;
        }

        $rack->save();

        return redirect()
            ->route('colocation_manager.racks.index')
            ->with('success', 'Rack has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('delete', $rack, Rack::class);

        $rack->delete();

        return redirect()
            ->route('colocation_manager.racks.index')
            ->with('success', 'Rack has been deleted successfully.');
    }

    public function spaces($id, $unit_number)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $rackSpace = $rack
            ->rackSpaces()
            ->where('unit_number', $unit_number)
            ->first();

        abort_if(!$rackSpace, 404);

        return view(
            'colocation_manager.racks.spaces.index',
            compact('rack', 'rackSpace')
        );
    }

    public function spaces_update($id, $unit_number, Request $request)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $rackSpace = $rack
            ->rackSpaces()
            ->where('unit_number', $unit_number)
            ->first();

        abort_if(!$rackSpace, 404);

        $request->validate([
            'name' => 'string|max:255|nullable',
            'description' => 'string|nullable',
            'client_email' => 'email|nullable',
            'client_id' => 'numeric|nullable',
            'hardware_type' => 'string|nullable',
            'switch_port' => 'string|nullable',
            'ipmi_port' => 'string|nullable',
            'subnet' => 'string|nullable',
        ]);

        $rackSpace->name = $request->name;
        $rackSpace->description = $request->description;
        $rackSpace->client_email = $request->client_email;
        $rackSpace->client_id = $request->client_id;
        $rackSpace->hardware_type = $request->hardware_type;
        $rackSpace->switch_port = $request->switch_port;
        $rackSpace->ipmi_port = $request->ipmi_port;
        $rackSpace->subnet = $request->subnet;

        $rackSpace->save();

        return redirect()
            ->route('colocation_manager.racks.show', $id)
            ->with('success', 'Rack space has been added successfully.');
    }

    public function spaces_destroy($id, $unit_number)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $rackSpace = $rack
            ->rackSpaces()
            ->where('unit_number', $unit_number)
            ->first();

        abort_if(!$rackSpace, 404);

        $rackSpace->name = null;
        $rackSpace->description = null;
        $rackSpace->client_email = null;
        $rackSpace->client_id = null;
        $rackSpace->hardware_type = null;
        $rackSpace->switch_port = null;
        $rackSpace->ipmi_port = null;
        $rackSpace->subnet = null;
        $rackSpace->save();

        return redirect()
            ->back()
            ->with('success', 'Rack space has been cleared successfully.');
    }

    public function spaces_move($id, $unit_number)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $rackSpace = $rack
            ->rackSpaces()
            ->where('unit_number', $unit_number)
            ->first();

        $rackSpaces = $rack
            ->rackSpaces()
            ->where('name', null)
            ->get();

        return view(
            'colocation_manager.racks.spaces.move',
            compact('rackSpaces', 'rackSpace', 'rack')
        );
    }

    public function spaces_move_store($id, $unit_number, Request $request)
    {
        $rack = Rack::findOrFail($id);

        $this->authorize('update', $rack, Rack::class);

        $request->validate([
            'moveto' => 'required|numeric',
        ]);

        $rackSpace = $rack
            ->rackSpaces()
            ->where('unit_number', $unit_number)
            ->first();

        $rackSpaceToMove = $rack
            ->rackSpaces()
            ->where('unit_number', $request->moveto)
            ->first();

        abort_if(!$rackSpace, 404);
        abort_if(!$rackSpaceToMove, 404);

        // swap the spaces

        $temp = $rackSpace->name;
        $rackSpace->name = $rackSpaceToMove->name;
        $rackSpaceToMove->name = $temp;

        $temp = $rackSpace->description;
        $rackSpace->description = $rackSpaceToMove->description;
        $rackSpaceToMove->description = $temp;

        $temp = $rackSpace->client_email;
        $rackSpace->client_email = $rackSpaceToMove->client_email;
        $rackSpaceToMove->client_email = $temp;

        $temp = $rackSpace->client_id;
        $rackSpace->client_id = $rackSpaceToMove->client_id;
        $rackSpaceToMove->client_id = $temp;

        $temp = $rackSpace->hardware_type;
        $rackSpace->hardware_type = $rackSpaceToMove->hardware_type;
        $rackSpaceToMove->hardware_type = $temp;

        $temp = $rackSpace->switch_port;
        $rackSpace->switch_port = $rackSpaceToMove->switch_port;
        $rackSpaceToMove->switch_port = $temp;

        $temp = $rackSpace->ipmi_port;
        $rackSpace->ipmi_port = $rackSpaceToMove->ipmi_port;
        $rackSpaceToMove->ipmi_port = $temp;

        $temp = $rackSpace->subnet;
        $rackSpace->subnet = $rackSpaceToMove->subnet;
        $rackSpaceToMove->subnet = $temp;

        $rackSpace->save();
        $rackSpaceToMove->save();

        return redirect()
            ->route('colocation_manager.racks.show', $id)
            ->with('success', 'Rack space has been moved successfully.');
    }
}
