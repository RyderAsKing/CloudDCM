@hasanyrole('user|subuser')
@can('view', App\Models\Rack::class)
<h1 class="text-xl font-bold mt-6">Your Locations</h1>
<div class="mt-2 grid grid-cols-3 gap-2">
    @foreach ($locations as $location)
    <div
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">{{$location->name}} <p class="text-green-700 text-sm">
                {{count($location->racks)}} Racks added
            </p>
        </h2>
        <p class="text-gray-700">{{$location->description}}</p>
    </div>
    @endforeach
    @if($uncategorized['racks'] > 0)
    <div
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">Uncategorized <p class="text-green-700 text-sm">
                {{$uncategorized['racks']}} Racks added
            </p>
        </h2>
        <p class="text-gray-700">
            Racks/Devices that are not assigned to any location
        </p>
    </div>
    @endif
</div>
@endcan

@can('view', App\Models\Rack::class)
<div class="mt02 grid grid-cols-2 gap-2">
    <div class="mt-4 bg-white border-2 border-gray-50 rounded-md shadow-sm p-7 ">
        <a href="#_" class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Racks
                Added
            </h5>
        </a>
        <p class="mb-4 text-neutral-500">There are a total of <strong>{{$racks}}</strong>
            racks added.
        </p>
    </div>
    <div class="mt-4 bg-white border-2 border-gray-50 rounded-md shadow-sm p-7">
        <a href="#_" class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Rack
                Units Added
            </h5>
        </a>
        <p class="mb-4 text-neutral-500">There are a total of
            <strong>{{$rackSpaces}}</strong> unit rack space added.
        </p>
    </div>
</div>
@endcan
@endhasanyrole