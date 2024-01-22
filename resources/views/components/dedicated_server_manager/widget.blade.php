@can('view', App\Models\Server::class)
<h1 class="text-xl font-bold mt-6">Server Manager (Locations/Groups)</h1>
@hasanyrole('user|subuser')
<div class="mt-2 grid grid-cols-3 gap-2">
    @foreach ($dedicatedServerManager['locations'] as $location)
    @if(isset($location->name))
    <a href="{{route('dedicated_server_manager.locations.show', $location->id)}}"
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">{{$location->name}} <p class="text-green-700 text-sm">
                {{count($location->servers)}} {{Str::plural('Server', count($location->servers))}} added
            </p>
        </h2>
        <p class="text-gray-700">{{$location->description}}</p>
    </a>
    @endif
    @endforeach
    @if($dedicatedServerManager['locations']['uncategorized'] > 0)
    <a href="{{route('dedicated_server_manager.servers.index')}}"
        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
        <h2 class="text-lg font-semibold mb-1">Uncategorized <p class="text-green-700 text-sm">
                {{$dedicatedServerManager['locations']['uncategorized']}} {{Str::plural('Server',
                $dedicatedServerManager['locations']['uncategorized'])}} added
            </p>
        </h2>
        <p class="text-gray-700">
            Server/Servers that are not assigned to any location/group
        </p>
    </a>
    @endif
</div>
@endhasanyrole

<div class=" grid grid-cols-3 gap-2">
    <div class="mt-4 bg-white border-2 border-gray-50 rounded-md shadow-sm p-7 ">
        <span class="block mb-3">
            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Server
                Added
            </h5>
        </span>
        <p class=" text-neutral-500">There are a total of <strong>{{$dedicatedServerManager['servers']}} </strong>
            Server added.
        </p>
    </div>
</div>
@endcan