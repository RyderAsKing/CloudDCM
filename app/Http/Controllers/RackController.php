<?php

namespace App\Http\Controllers;

use App\Models\Rack;
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

        return view('racks.index', compact('racks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Rack::class);

        return view('racks.create');
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
        ]);

        $rack = new Rack();

        $rack->name = $request->name;
        $rack->description = $request->description;
        $rack->user_id = auth()
            ->user()
            ->isSubUser()
            ? auth()->user()->owner->id
            : auth()->user()->id;

        $rack->save();

        for ($i = 1; $i <= $request->rack_size; $i++) {
            RackSpace::create([
                'rack_id' => $rack->id,
                'unit_number' => $i,
            ]);
        }

        return redirect('/racks')->with(
            'success',
            'Rack has been added successfully.'
        );
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

        return view('racks.show', compact('rack'));
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

        return redirect('/racks')->with(
            'success',
            'Rack has been deleted successfully.'
        );
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

        return view('racks.spaces.index', compact('rack', 'rackSpace'));
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

        return redirect('/racks/' . $id)->with(
            'success',
            'Rack space has been added successfully.'
        );
    }
}
