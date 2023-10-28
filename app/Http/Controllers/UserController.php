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
        // list all users
        // check if the user is admin or user
        // if admin, show all users
        // if user, show only users that belong to the owner_id of the user

        // if the user is admin, show all users
        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            // get all users
            $users = \App\Models\User::paginate(20);
        } else {
            // if the user is not admin, show only users that belong to the owner_id of the user
            $users = \App\Models\User::where(
                'owner_id',
                auth()->user()->id
            )->paginate(20);
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
        // show the form for creating a new user

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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'owner_id' => 'integer|exists:users,id|nullable',
        ]);

        if (
            auth()
                ->user()
                ->hasRole('user') &&
            !auth()
                ->user()
                ->hasRole('admin')
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
        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            return redirect()->route('impersonate', $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // show the form for editing a user's profile

        // get the user from the database
        $user = User::findOrFail($id);
        $permissions = [];
        if (
            $user->owner_id == auth()->user()->id ||
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            $permissions = Permission::all();
        } else {
            return redirect()
                ->route('users.index')
                ->with('error', 'You are not the owner of this user!');
        }

        // return the view with the user
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'permissions' => 'array',
        ]);

        $user = User::findOrFail($id);
        if (
            $user->owner_id == auth()->user()->id ||
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->input('password') != null) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->save();

            $user->syncPermissions($request->input('permissions'));
        } else {
            return redirect()
                ->route('users.index')
                ->with('error', 'You are not the owner of this user!');
        }

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
        if (
            auth()
                ->user()
                ->hasRole('admin') == false
        ) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You are not allowed to access this page!');
        }
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
