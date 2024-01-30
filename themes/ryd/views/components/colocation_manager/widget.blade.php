@can('view', App\Models\Rack::class)
<h1 class="text-xl font-bold mt-6">Colocation Manager (Locations)</h1>
@hasanyrole('user|subuser')
<div class="mt-2 grid grid-cols-3 gap-2">
    @foreach ($colocationManager['locations'] as $location)
    @if(isset($location->name))
    <a href="{{route('colocation_manager.locations.show', $location->id)}}"
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">{{$location->name}} <p class="text-green-700 text-sm">
                {{count($location->racks)}} {{Str::plural('Rack', count($location->racks))}} added
            </p>
        </h2>
        <p class="text-gray-700">{{$location->description}}</p>
    </a>
    @endif
    @endforeach
    @if($colocationManager['locations']['uncategorized'] > 0)
    <a href="{{route('colocation_manager.racks.index')}}"
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">Uncategorized <p class="text-green-700 text-sm">
                {{$colocationManager['locations']['uncategorized']}} {{Str::plural('Rack',
                $colocationManager['locations']['uncategorized'])}} added
            </p>
        </h2>
        <p class="text-gray-700">
            Racks/Devices that are not assigned to any location
        </p>
    </a>
    @endif
</div>
@endhasanyrole

<div class=" grid grid-cols-3 gap-2">
    <div class="mt-4 bg-white border-2 border-gray-50 rounded-md shadow-sm p-7 ">
        <span class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Racks
                Added
            </h5>
        </span>
        <p class="text-green-700 text-sm font-semibold">
            {{$colocationManager['rackSpaces']}} unit rack {{Str::plural('space',
            $colocationManager['rackSpaces'])}} added
        </p>
        <p class=" text-neutral-500">There are a total of <strong>{{$colocationManager['racks']}}</strong>
            racks added.
        </p>
    </div>
    {{-- <div class="mt-4 bg-white border-2 border-gray-50 rounded-md shadow-sm p-7">
        <span class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Rack
                Units Added
            </h5>
        </span>
        <p class=" text-neutral-500">There are a total of
            <strong>{{$colocationManager['rackSpaces']}}</strong> unit rack space added.
        </p>
    </div> --}}
</div>
@endcan