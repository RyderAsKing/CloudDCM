<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="">
                        <!-- Card 1 -->
                        <div class="backdrop-blur-sm bg-white/20 p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                            <h2 class="text-xl font-semibold mb-4">Welcome to dashboard</h2>
                            <p class="text-gray-700">Here you can manage colocation rack space with ease</p>

                            <a href="{{ route('racks.index') }}"
                                class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">Manage
                                now
                                &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-4  bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                            <a href="#_" class="block mb-3">
                                <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Racks
                                    Added
                                </h5>
                            </a>
                            <p class="mb-4 text-neutral-500">You are managing a total of <strong>{{$racks}}</strong>
                                racks.
                            </p>
                        </div>
                        <div class="mt-4  bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                            <a href="#_" class="block mb-3">
                                <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Rack
                                    Units Added
                                </h5>
                            </a>
                            <p class="mb-4 text-neutral-500">You are managing a total of
                                <strong>{{$rackSpaces}}</strong> unit rack space.
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>