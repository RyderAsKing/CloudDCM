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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            <a href="{{route('colocation_manager.locations.create')}}" type="button"
                class="mb-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                Add Location +
            </a>
            <div class="flex flex-col">

                <div class="mt-2 grid grid-cols-3 gap-2">
                    @foreach ($locations as $location)
                    @if(isset($location->name))
                    <a href="{{route('colocation_manager.locations.show', $location->id)}}"
                        class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm hover:shadow-md cursor-pointer border-2 border-gray-50 transition">
                        <h2 class="text-lg font-semibold mb-1">{{$location->name}} <p class="text-green-700 text-sm">
                                {{count($location->racks)}} Racks added
                            </p>
                        </h2>
                        <p class="text-gray-700">{{$location->description}}</p>
                    </a>
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