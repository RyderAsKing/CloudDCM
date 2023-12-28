@hasrole('admin')
<div class="backdrop-blur-sm bg-white/20 rounded-md  ">
    <h2 class="text-xl font-semibold mb-2">Welcome to admin dashboard</h2>
    <p class="text-gray-700">Here you can manage users and their subusers</p>

    <x-primary-link class="mt-2" href="{{ route('users.index') }}">
        Manage
        now
        &rarr;
    </x-primary-link>
</div>
@endhasrole

@hasanyrole('user|subuser')
<div class="backdrop-blur-sm bg-white/20 rounded-md ">
    <h2 class="text-xl font-semibold mb-2">Welcome to your dashboard</h2>
    <p class="text-gray-700">Here are the modules you have access to </p>

    @can('view', App\Models\Rack::class)
    <x-primary-link class="mt-2" href="{{ route('colocation_manager.locations.index') }}">
        Colocation Manager &rarr; </x-primary-link>
    @endcan

    @can('view', App\Models\Customer::class)
    <x-primary-link class="mt-2" href="{{route('customer_relationship_manager.customers.index')}}">
        Customer Relationship Manager &rarr;
    </x-primary-link>
    @endhasrole
</div>
@endhasanyrole

@hasrole('admin')
<div class="mt-6 grid grid-cols-2 gap-2">
    <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
        <x-primary-link href="#_" class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Users
                Created
            </h5>
        </x-primary-link>
        <p class="mb-4 text-neutral-500">There are a total of <strong>{{$users}}</strong>
            users created.
        </p>
    </div>
</div>
@endhasrole