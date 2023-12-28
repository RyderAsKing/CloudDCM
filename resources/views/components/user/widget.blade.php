@hasrole('admin')
<div class="backdrop-blur-sm bg-white/20 rounded-md  ">
    <h2 class="text-xl font-semibold mb-2">Welcome to admin dashboard</h2>
    <p class="text-gray-700">Here you can manage users and their subusers</p>

    <a href="{{ route('users.index') }}"
        class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">Manage
        now
        &rarr;
    </a>
</div>
@endhasrole

@hasanyrole('user|subuser')
<div class="backdrop-blur-sm bg-white/20 rounded-md ">
    <h2 class="text-xl font-semibold mb-2">Welcome to your dashboard</h2>
    <p class="text-gray-700">Here are the modules you have access to </p>

    @can('view', App\Models\Rack::class)
    <a href="{{ route('colocation_manager.locations.index') }}"
        class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
        Colocation Manager &rarr; </a>
    @endcan

    @can('view', App\Models\Customer::class)
    <a href="{{route('customer_relationship_manager.customers.index')}}"
        class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
        Customer Relationship Manager &rarr;
    </a>
    @endhasrole
</div>
@endhasanyrole

@hasrole('admin')
<div class="mt-6 grid grid-cols-2 gap-2">
    <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
        <a href="#_" class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Users
                Created
            </h5>
        </a>
        <p class="mb-4 text-neutral-500">There are a total of <strong>{{$users}}</strong>
            users created.
        </p>
    </div>
</div>
@endhasrole