<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list', User::class);

        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            $users = User::paginate(20);
        } else {
            $users = User::where('owner_id', auth()->user()->id)->paginate(20);
        }

        // return the view with the users
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'owner_id' => 'integer|exists:users,id|nullable',
        ]);

        if (
            auth()
                ->user()
                ->isUser()
        ) {
            $request->merge([
                'owner_id' => auth()->user()->id,
            ]);
        }

        $user = new \App\Models\User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->owner_id = $request->input('owner_id');
        $user->save();

        if ($request->owner_id != null) {
            $user->assignRole('subuser');
        } else {
            $user->assignRole('user');
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('impersonate', User::class);

        return redirect()->route('impersonate', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user, User::class);
        $permissions = Permission::all();

        return view('users.edit', compact('user', 'permissions'));
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
        $user = User::findOrFail($id);
        $this->authorize('update', $user, User::class);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'permissions' => 'array',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        $user->syncPermissions($request->input('permissions'));

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete a user from the database
    }

    public function search(Request $request)
    {
        $this->authorize('search', User::class);

        $searchTerm = $request->input('term');
        $results = User::where('email', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->get(['id', 'email', 'name']);

        $formattedResults = [];
        foreach ($results as $user) {
            $formattedResults[] = [
                'id' => $user->id,
                'text' => $user->email . ' (' . $user->name . ')',
            ];
        }
        return response()->json($formattedResults);
    }
}
