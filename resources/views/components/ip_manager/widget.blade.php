@can('view', App\Models\Subnet::class)
<h1 class="text-xl font-bold mt-6">Subnet Manager (IP)</h1>
<div class="mt-2 grid grid-cols-3 gap-2">
    <div class=" bg-white border-2 border-gray-50 rounded-md shadow-sm p-7">
        <a href="{{route('ip_manager.subnets.index')}}" class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Subnets
                Added
            </h5>
        </a>
        <p class="text-green-700 text-sm font-semibold">
            {{$ipManager['sub_subnets']}} sub {{Str::plural('subnet',
            $ipManager['sub_subnets'])}} added
        </p>
        <p class=" text-neutral-500">There are a total of
            <strong>{{$ipManager['subnets']}}</strong>
            parent subnets added.
        </p>
    </div>
</div>
@endcan