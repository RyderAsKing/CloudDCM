<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Managing rack {{$rack->name}}
        </h2>
    </x-slot>

    {{-- loop through rackSpaces and display all rackSpaces in a nice formatted table with options to edit and delete.
    the rows are name, description, client_email.
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
                    <h2 class="text-xl font-semibold mb-4">Rack spaces</h2>

                </div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2" style="width: 20%">Name</th>
                            <th class="px-4 py-2" style="width: 40%">Description</th>
                            <th class="px-4 py-2" style="width: 20%">Client Email</th>
                            <th class="px-4 py-2 ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($rack->rackSpaces->count() < 1) <tr>
                            <td colspan="4" class="text-center py-4">No rackSpaces found.</td>
                            </tr>
                            @endif

                            @foreach ($rack->rackSpaces as $rackSpace)
                            <tr>
                                <td class="border px-4 py-2">{{ $rackSpace->unit_number }}</td>
                                <td class="border px-4 py-2"> @if($rackSpace->name != null) {{ $rackSpace->name }} @else
                                    Not assigned @endif</td>
                                <td class="border px-4 py-2">@if($rackSpace->description != null) {{
                                    $rackSpace->description }} @else
                                    Not assigned @endif</td>
                                <td class="border px-4 py-2">@if($rackSpace->client_email != null) {{
                                    $rackSpace->client_email }} @else
                                    Not assigned @endif</td>
                                <td class="border px-4 py-2">

                                    <a href="{{ route('racks.spaces', $rackSpace->id) }}" class="text-white bg-gradient-to-r from-blue-300 to-indigo-300 border border-fuchsia-00 hover:border-violet-100
                                        font-semibold py-1 px-4 rounded-md transition-colors duration-300"
                                        style="width: fit-content;">
                                        Edit &rarr;
                                    </a>

                                </td>

                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                </div>
            </div>
        </div>
    </div>



</x-app-layout>