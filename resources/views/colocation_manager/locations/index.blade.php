<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Location') }}
        </h2>
    </x-slot>

    {{-- loop through locations and display all locations in a nice formatted div with options to view edit and
    delete.
    style using Tailwind css
    --}}

    <div>
        <div class=" mx-auto ">

            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
            @endif

            <x-primary-link class="mb-2" href="{{route('colocation_manager.locations.create')}}" type="button">
                Add Location +
            </x-primary-link>
            <x-primary-link class="mb-2" href="{{route('colocation_manager.racks.create')}}" type="button">
                Add Rack +
            </x-primary-link>
            <div class="flex flex-col">
                <div class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                    <h2 class="text-xl font-semibold mb-4">Welcome to Colocation Manager</h2>
                    <p class="text-gray-700">Here you can manage locations and their racks</p>
                    @if(count($locations) < 2) <p class="text-gray-700">You have no locations yet, click the button
                        above to get started</p>

                        @endif
                </div>
                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach ($locations as $location)
                    @if(isset($location->name))
                    <div
                        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
                        <h2 class="text-lg font-semibold mb-1 flex justify-between">{{$location->name}}


                            <a class="text-md" href="{{route('colocation_manager.locations.edit', $location->id)}}">Edit
                                &rarr;</a>

                        </h2>
                        <a href="{{route('colocation_manager.locations.show', $location->id)}}">
                            <p class="text-green-700 text-sm font-bold">
                                {{count($location->racks)}} Racks added
                            </p>
                            <p class="text-gray-700">{{$location->description}}</p>
                        </a>
                    </div>
                    @endif
                    @endforeach
                    @if($locations['uncategorized'] > 0)
                    <a href="{{route('colocation_manager.racks.index')}}"
                        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
                        <h2 class="text-lg font-semibold mb-1">Uncategorized <p class="text-green-700 text-sm">
                                {{$locations['uncategorized']}} Racks added
                            </p>
                        </h2>
                        <p class="text-gray-700">
                            Racks/Devices that are not assigned to any location
                        </p>

                    </a>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                {{ $locations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>