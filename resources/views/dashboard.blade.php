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
                    <!-- Card 1 -->
                    @hasrole('admin')
                    <div class="backdrop-blur-sm bg-white/20 p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                        <h2 class="text-xl font-semibold mb-4">Welcome to admin dashboard</h2>
                        <p class="text-gray-700">Here you can manage users and their subusers</p>

                        <a href="{{ route('users.index') }}"
                            class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">Manage
                            now
                            &rarr;
                        </a>
                    </div>
                    @endhasrole

                    @hasanyrole('user|subuser')

                    @if(count($locations) < 1) <div
                        class="backdrop-blur-sm bg-white/20 p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                        <h2 class="text-xl font-semibold mb-2">Welcome to your dashboard</h2>
                        <p class="text-gray-700">Add a new location to get started with managing </p>

                        <a href="{{ route('users.index') }}"
                            class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">Add
                            Location +
                        </a>
                </div>
                @else
                <h1 class="text-xl font-bold mb-4">Your Locations</h1>
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
                </div>
                @endif

                @endhasanyrole


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

                    @hasrole('admin')
                    <div class=" bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                        <a href="#_" class="block mb-3">
                            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Total Users
                                Created
                            </h5>
                        </a>
                        <p class="mb-4 text-neutral-500">There are a total of <strong>{{$users}}</strong>
                            users created.
                        </p>
                    </div>

                    @endhasrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>