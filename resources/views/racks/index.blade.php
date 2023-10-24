<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- loop through racks and display all racks in a nice formatted table with options to view edit and delete
        --}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Rack Name</th>
                            <th class="px-4 py-2">Rack Description</th>
                            <th class="px-4 py-2">Number of Spaces</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($racks) == 0)
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="4">No racks found.</td>
                        </tr>
                        @endif
                        @foreach ($racks as $rack)
                        <tr>
                            <td class="border px-4 py-2">{{ $rack->name }}</td>
                            <td class="border px-4 py-2">{{ $rack->description }}</td>
                            <td class="border px-4 py-2">{{ count($rack->rack_spaces) }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('racks.show', $rack->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</a>
                                <a href="{{ route('racks.edit', $rack->id) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                <form action="{{ route('racks.destroy', $rack->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px
                                        -4 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <a href="{{ route('racks.create') }}"
                class="mt-2 flex items-center bg-white from-violet-300 to-indigo-300  border border-fuchsia-00 hover:border-violet-100 font-semibold py-2 px-4 rounded-md transition-colors duration-300"
                style="width: fit-content;">Add Rack</a>
        </div>

    </div>
</x-app-layout>