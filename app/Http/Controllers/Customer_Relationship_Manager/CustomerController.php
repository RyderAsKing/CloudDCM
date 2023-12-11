<?php

namespace App\Http\Controllers\Customer_Relationship_Manager;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('view', Customer::class);

        $customers = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->customers()
                ->paginate(10)
            : auth()
                ->user()
                ->customers()
                ->paginate(10);

        return view(
            'customer_relationship_manager.customers.index',
            compact('customers')
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
        $this->authorize('create', Customer::class);

        return view('customer_relationship_manager.customers.create');
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
        $this->authorize('create', Customer::class);

        $request->validate([
            'company_name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable',
            'contact_name' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'sales_person' => 'nullable',
            'num_desktops' => 'nullable|numeric|min:0',
            'num_notebooks' => 'nullable|numeric|min:0',
            'num_printers' => 'nullable|numeric|min:0',
            'num_servers' => 'nullable|numeric|min:0',
            'num_firewalls' => 'nullable|numeric|min:0',
            'num_wifi_access_points' => 'nullable|numeric|min:0',
            'num_switches' => 'nullable|numeric|min:0',
            'quote_provided' => 'nullable',
        ]);

        $customer = auth()
            ->user()
            ->isSubUser()
            ? auth()
                ->user()
                ->owner->customers()
                ->create($request->all())
            : auth()
                ->user()
                ->customers()
                ->create($request->all());

        return redirect()
            ->route('customer_relationship_manager.customers.index')
            ->with('success', 'Customer created!');
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
        $customer = Customer::findOrFail($id);

        $this->authorize('show', $customer, Customer::class);

        return view(
            'customer_relationship_manager.customers.show',
            compact('customer')
        );
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
        $customer = Customer::findOrFail($id);

        $this->authorize('update', $customer, Customer::class);
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
        $customer = Customer::findOrFail($id);

        $this->authorize('update', $customer, Customer::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $this->authorize('delete', $customer, Customer::class);
    }
}
