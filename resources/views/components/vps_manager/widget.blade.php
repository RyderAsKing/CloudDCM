@hasanyrole('user|subuser')
@can('view', App\Models\VPS::class)
<h1 class="text-xl font-bold mt-6">VPS Manager (Locations/Groups)</h1>
<div class="mt-2 grid grid-cols-3 gap-2">
    @foreach ($vpsManager['locations'] as $location)
    @if(isset($location->name))
    <a href="{{route('vps_manager.locations.show', $location->id)}}"
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">{{$location->name}} <p class="text-green-700 text-sm">
                {{count($location->vpss)}} {{Str::plural('VPS', count($location->vpss))}} added
            </p>
        </h2>
        <p class="text-gray-700">{{$location->description}}</p>
    </a>
    @endif
    @endforeach
    @if($vpsManager['locations']['uncategorized'] > 0)
    <a href="{{route('vps_manager.vpss.index')}}"
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">Uncategorized <p class="text-green-700 text-sm">
                {{$vpsManager['locations']['uncategorized']}} {{Str::plural('VPS',
                $vpsManager['locations']['uncategorized'])}} added
            </p>
        </h2>
        <p class="text-gray-700">
            VPS/Servers that are not assigned to any location/group
        </p>
    </a>
    @endif
</div>
@endcan

@can('view', App\Models\VPS::class)
<div class=" grid grid-cols-3 gap-2">
    <div class="mt-4 bg-white border-2 border-gray-50 rounded-md shadow-sm p-7 ">
        <span class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total VPS
                Added
            </h5>
        </span>
        <p class=" text-neutral-500">There are a total of <strong>{{$vpsManager['vps']}} </strong>
            VPS added.
        </p>
    </div>

</div>
@endcan
@endhasanyrole