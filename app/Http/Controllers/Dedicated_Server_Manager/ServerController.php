<?php

namespace App\Http\Controllers\Dedicated_Server_Manager;

use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Server::class);

        $servers = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->servers()
                ->paginate(10)
            : auth()
                ->user()
                ->servers()
                ->paginate(10);

        return view(
            'dedicated_server_manager.servers.index',
            compact('servers')
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', Server::class);

        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'server')
                ->get()
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'server')
                ->get();
        return view(
            'dedicated_server_manager.servers.create',
            compact('locations')
        );
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
        $this->authorize('create', Server::class);

        $this->validate($request, [
            'hostname' => 'required',
            'ip_address' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'location_id' => 'nullable|integer',
            'cpu' => 'nullable|string',
            'memory' => 'nullable|string',
            'storage' => 'nullable|string',
            'os' => 'nullable|string',
        ]);

        $server = new Server();
        $server->hostname = $request->hostname;
        $server->ip_address = $request->ip_address;
        $server->username = $request->username;
        $server->password = $request->password;

        // specifications
        $server->cpu = $request->cpu;
        $server->memory = $request->memory;
        $server->storage = $request->storage;
        $server->os = $request->os;

        if ($request->location_id) {
            $server->location_id = $request->location_id;
        }
        $server->user_id = auth()
            ->user()
            ->isSubUser()
            ? auth()->user()->owner->id
            : auth()->user()->id;

        $server->save();

        return redirect()
            ->route('dedicated_server_manager.servers.index')
            ->with('success', 'Server created successfully');
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
    public function edit(Server $server)
    {
        //
        $this->authorize('update', $server);

        $locations = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->locations()
                ->where('for', '=', 'server')
                ->get()
            : auth()
                ->user()
                ->locations()
                ->where('for', '=', 'server')
                ->get();

        return view(
            'dedicated_server_manager.servers.edit',
            compact('server', 'locations')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        //
        $this->validate($request, [
            'hostname' => 'required',
            'ip_address' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'location_id' => 'nullable|integer',
            'cpu' => 'nullable|string',
            'memory' => 'nullable|string',
            'storage' => 'nullable|string',
            'os' => 'nullable|string',
        ]);

        $this->authorize('update', $server);

        $server->hostname = $request->hostname;
        $server->ip_address = $request->ip_address;
        $server->username = $request->username;
        $server->password = $request->password;

        $server->location_id = $request->location_id;

        // specifications
        $server->cpu = $request->cpu;
        $server->memory = $request->memory;
        $server->storage = $request->storage;
        $server->os = $request->os;

        $server->save();

        return redirect()
            ->route('dedicated_server_manager.servers.index')
            ->with('success', 'Server updated successfully');
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
        $server = Server::findOrFail($id);

        $this->authorize('delete', $server);

        $server->delete();

        return redirect()
            ->route('dedicated_server_manager.servers.index')
            ->with('success', 'Server deleted successfully');
    }
}
