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

        $users = auth()
            ->user()
            ->isUser()
            ? User::where('owner_id', auth()->user()->id)->paginate(20)
            : User::paginate(20);

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
            'colocation_manager' => 'nullable',
            'customer_relationship_manager' => 'nullable',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->owner_id = auth()
            ->user()
            ->isUser()
            ? auth()->user()->id
            : $request->input('owner_id');
        $user->save();

        if ($user->owner_id != null) {
            $user->assignRole('subuser');
        } else {
            $user->assignRole('user');

            if ($request->input('colocation_manager') != null) {
                $user->assignRole('colocation_manager');
            }

            if ($request->input('customer_relationship_manager') != null) {
                $user->assignRole('customer_relationship_manager');
            }
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
            'colocation_manager' => 'nullable',
            'customer_relationship_manager' => 'nullable',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            if ($request->input('colocation_manager') != null) {
                $user->assignRole('colocation_manager');
            } else {
                $user->removeRole('colocation_manager');
            }

            if ($request->input('customer_relationship_manager') != null) {
                $user->assignRole('customer_relationship_manager');
            } else {
                $user->removeRole('customer_relationship_manager');
            }
        }
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
        $user = User::findOrFail($id);

        $this->authorize('delete', $user, User::class);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully!');
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
