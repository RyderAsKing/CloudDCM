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
                ->whereNull('parent_id')
                ->paginate(10)
            : auth()
                ->user()
                ->subnets()
                ->whereNull('parent_id')
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

        $subnets = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->subnets()
                ->where('parent_id', null)
                ->get()
            : auth()
                ->user()
                ->subnets()
                ->where('parent_id', null)
                ->get();

        return view('ip_manager.subnets.create', compact('subnets'));
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

        $request->validate([
            // name, subnet (nullable), vlan (nullable), leased_company (nullable), parent_id (nullable)
            'name' => 'required|string|max:255',
            'subnet' => 'nullable|string|max:255',
            'vlan' => 'nullable|string|max:255',
            'leased_company' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:subnets,id',
        ]);

        $subnet = new Subnet();
        $subnet->name = $request->name;
        $subnet->subnet = $request->subnet;
        $subnet->vlan = $request->vlan;
        $subnet->leased_company = $request->leased_company;
        $subnet->parent_id = $request->parent_id;
        $subnet->user_id = auth()
            ->user()
            ->isSubUser()
            ? auth()->user()->owner->id
            : auth()->user()->id;
        $subnet->save();

        return redirect()
            ->route('ip_manager.subnets.index')
            ->with('success', 'Subnet created successfully.');
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

        // dd('SubnetController@show');
        // redirect to edit page

        return redirect()->route('ip_manager.subnets.edit', $subnet);
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

        // dd('SubnetController@edit');

        $subnets = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->subnets()
                ->where('parent_id', null)
                ->get()
            : auth()
                ->user()
                ->subnets()
                ->where('parent_id', null)
                ->get();

        $children = $subnet->children()->get();

        $ips = $subnet->ips()->paginate(25);

        return view(
            'ip_manager.subnets.edit',
            compact('subnet', 'children', 'subnets', 'ips')
        );
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

        $request->validate([
            // name, subnet (nullable), vlan (nullable), leased_company (nullable), parent_id (nullable)
            'name' => 'required|string|max:255',
            'subnet' => 'nullable|string|max:255',
            'vlan' => 'nullable|string|max:255',
            'leased_company' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:subnets,id',
        ]);

        $subnet->name = $request->name;
        $subnet->subnet = $request->subnet;
        $subnet->vlan = $request->vlan;
        $subnet->leased_company = $request->leased_company;

        if ($subnet->parent_id != $request->parent_id) {
            if ($subnet->children()->count() > 0) {
                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Subnet has children, cannot change parent.'
                    );
            }
        }

        $subnet->parent_id = $request->parent_id;
        $subnet->save();

        return redirect()
            ->route('ip_manager.subnets.index')
            ->with('success', 'Subnet updated successfully.');
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

        $subnet->delete();

        return redirect()
            ->route('ip_manager.subnets.index')
            ->with('success', 'Subnet deleted successfully.');
    }

    public function range(Subnet $subnet, Request $request)
    {
        $this->authorize('create', Subnet::class);

        $request->validate([
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
        ]);

        $start = ip2long($request->start);
        $end = ip2long($request->end);

        if ($start > $end) {
            return redirect()
                ->back()
                ->with('error', 'Start IP cannot be greater than End IP.');
        }

        $ips = [];

        for ($i = $start; $i <= $end; $i++) {
            $ips[] = long2ip($i);
        }

        if (count($ips) > 256) {
            return redirect()
                ->back()
                ->with('error', 'IP range cannot be greater than 256.');
        }

        $existing_ips = $subnet
            ->ips()
            ->whereIn('ip', $ips)
            ->get();

        if ($existing_ips->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'IPs already exist.');
        }

        $subnet->ips()->createMany(
            array_map(function ($ip) {
                return ['ip' => $ip];
            }, $ips)
        );

        return redirect()
            ->back()
            ->with('success', 'IP range created successfully.');
    }
}
