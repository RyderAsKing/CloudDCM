@hasanyrole('user|subuser')
@can('view', App\Models\Customer::class)
<h1 class="text-xl font-bold mt-6">Customer Relationship Manager</h1>
<div class="mt-2 grid grid-cols-3 gap-2">
    <div class=" bg-white border-2 border-gray-50 rounded-md shadow-sm p-7">
        <a href="{{route('customer_relationship_manager.customers.index')}}" class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Customers
                Added
            </h5>
        </a>
        <p class="mb-4 text-neutral-500">There are a total of
            <strong>{{$customerRelationshipManager['customers']}}</strong>
            customers added.
        </p>
    </div>
</div>
@endcan
@endhasrole