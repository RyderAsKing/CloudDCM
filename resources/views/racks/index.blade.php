<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Racks') }}
        </h2>
    </x-slot>

    {{-- loop through racks and display all racks in a nice formatted table with options to view edit and delete.
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

            <div class="bg-white overflow-hidden shadow-xl p-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold mb-4">Racks</h2>
                    <a href="{{ route('racks.create') }}"
                        class="text-white mt-2 flex items-center bg-gradient-to-r from-blue-300 to-indigo-300  border border-fuchsia-00 hover:border-violet-100 font-semibold py-2 px-4 rounded-md transition-colors duration-300"
                        style="width: fit-content;">Add
                        Rack
                        &rarr;
                    </a>
                </div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Size</th>
                            <th class="px-4 py-2 ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($racks) < 1) <tr>
                            <td colspan="4" class="text-center py-4">No racks found.</td>
                            </tr>
                            @endif

                            @foreach ($racks as $rack)
                            <tr>
                                <td class="border px-4 py-2">{{ $rack->name }}</td>
                                <td class="border px-4 py-2" style="width: 50%">{{ $rack->description }}</td>
                                <td class="border px-4 py-2">{{ count($rack->rackSpaces) }}</td>

                                <td class="border px-4 py-2" style="width: 20%">
                                    <a href="{{ route('racks.show', $rack->id) }}"
                                        class="text-white bg-gradient-to-r from-blue-300 to-indigo-300  border border-fuchsia-00 hover:border-violet-100 font-semibold py-1 px-4 rounded-md transition-colors duration-300"
                                        style="width: fit-content;">View &rarr;</a>
                                    <a href="{{ route('racks.edit', $rack->id) }}"
                                        class="text-white bg-gradient-to-r from-blue-300 to-indigo-300  border border-fuchsia-00 hover:border-violet-100 font-semibold py-1 px-4 rounded-md transition-colors duration-300"
                                        style="width: fit-content;">Edit &rarr;</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $racks->links() }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>