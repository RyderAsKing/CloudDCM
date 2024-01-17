@hasrole('admin')
<div class="backdrop-blur-sm  rounded-md  ">
    <h2 class="text-xl font-semibold mb-2">Welcome to admin dashboard</h2>
    <p class="text-gray-700">Here you can manage users and their subusers</p>

    <x-primary-link href="{{ route('users.index') }}" class="mt-4">
        Manage
        now
        &rarr;
    </x-primary-link>
</div>
@endhasrole

@hasanyrole('user|subuser')
<div class="backdrop-blur-sm  rounded-md ">
    <h2 class="text-xl font-semibold mb-2">Welcome to your dashboard</h2>
    <p class="text-gray-700">Here are the modules you have access to </p>

    @can('view', App\Models\Rack::class)
    <x-primary-link href="{{ route('colocation_manager.locations.index') }}" class="mt-4">
        Colocation Manager &rarr; </x-primary-link>
    @endcan

    @can('view', App\Models\Customer::class)
    <x-primary-link href="{{route('customer_relationship_manager.customers.index')}}" class="mt-4">
        Customer Relationship Manager &rarr;
    </x-primary-link>
    @endcan

    @can('view', App\Models\VPS::class)
    <x-primary-link href="{{route('vps_manager.locations.index')}}" class="mt-4">
        VPS Manager &rarr;
    </x-primary-link>
    @endcan

    @can('view', App\Models\Subnet::class)
    <x-primary-link href="{{route('ip_manager.subnets.index')}}" class="mt-4">
        IP Manager &rarr;
    </x-primary-link>
    @endcan
</div>
@endhasanyrole

@hasrole('admin')
<h1 class="text-xl font-bold mt-6">User Manager (Companies)</h1>
<div class="mt-6 grid grid-cols-3 gap-2">
    <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
        <span class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Users
                Created
            </h5>
        </span>
        <p class="text-neutral-500">There are a total of <strong>{{$users}}</strong>
            users created.
        </p>
    </div>
</div>
@endhasrole