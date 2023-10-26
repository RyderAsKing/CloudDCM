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
        $racks = Rack::paginate(10);

        return view('racks.index', compact('racks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $request->validate([
            'name' => 'required|unique:racks|max:255',
            'description' => 'required',
            'rack_size' => 'numeric|required|min:1|max:256',
        ]);

        $rack = new Rack();

        $rack->name = $request->name;
        $rack->description = $request->description;

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
        // finding the rack with the id and returning it along with its rack spaces (lazy loading)

        $rack = Rack::find($id);

        // dd($rack->rackSpaces->count()); gives 123
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
        Rack::destroy($id);

        return redirect('/racks')->with(
            'success',
            'Rack has been deleted successfully.'
        );
    }

    public function spaces($id, $unit_number)
    {
        $rack = Rack::find($id);

        $rackSpace = RackSpace::where('rack_id', $id)
            ->where('unit_number', $unit_number)
            ->first();

        return view('racks.spaces.index', compact('rack', 'rackSpace'));
    }

    public function spaces_update($id, $unit_number, Request $request)
    {
        $rack_space = RackSpace::where('rack_id', $id)
            ->where('unit_number', $unit_number)
            ->first();

        $request->validate([
            'name' => 'string|max:255|nullable',
            'description' => 'string|nullable',
            'client_email' => 'email|nullable',
            'client_id' => 'numeric|nullable',
            'hardware_type' => 'string|nullable',
            'switch_port' => 'numeric|nullable',
            'ipmi_port' => 'numeric|nullable',
            'subnet' => 'string|nullable',
        ]);

        $rack_space->name = $request->name;
        $rack_space->description = $request->description;
        $rack_space->client_email = $request->client_email;
        $rack_space->client_id = $request->client_id;
        $rack_space->hardware_type = $request->hardware_type;
        $rack_space->switch_port = $request->switch_port;
        $rack_space->ipmi_port = $request->ipmi_port;
        $rack_space->subnet = $request->subnet;

        $rack_space->save();

        return redirect('/racks/' . $id)->with(
            'success',
            'Rack space has been added successfully.'
        );
    }
}
