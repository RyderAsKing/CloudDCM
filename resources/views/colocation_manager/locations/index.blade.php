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


                            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
                                <button @click="modalOpen=true">X</button>
                                <template x-teleport=" body">
                                    <div x-show="modalOpen"
                                        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                        x-cloak>
                                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            @click="modalOpen=false"
                                            class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
                                        </div>
                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-90"
                                            class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                                            <div class="flex items-center justify-between pb-3">
                                                <h3 class="text-lg font-semibold">Delete location?</h3>
                                                <button @click="modalOpen=false"
                                                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="relative w-auto pb-8">
                                                <p>This action cannot be undone. Are you sure you want to delete this
                                                    location?</p>
                                            </div>
                                            <div
                                                class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                                                <button @click="modalOpen=false" type="button"
                                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">
                                                    Go back &larr;
                                                </button>
                                                <form
                                                    action="{{route('colocation_manager.locations.destroy', $location->id)}}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                                        Yes &cross;
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

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