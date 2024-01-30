<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Racks') }}
        </h2>
    </x-slot>

    {{-- loop through racks and display all racks in a nice formatted table with options to view edit and delete.
    style using Tailwind css
    --}}

    <div>
        <div class="mx-auto ">

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

            <x-primary-link href="{{route('colocation_manager.racks.create')}}" class="mb-2">
                Add rack +
            </x-primary-link>
            <div class="flex flex-col">

                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-white">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Name</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Description
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Size</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Location</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @if ($racks->isEmpty())

                                    <tr class="bg-white text-neutral-500">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">No racks found.
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        </td>
                                    </tr>
                                    @endif

                                    @foreach ($racks as $rack)
                                    <tr class="text-neutral-800 bg-white">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap flex items-center">
                                            {{$rack->name}}<span
                                                class="bg-black text-white  text-xs font-semibold pl-2 pr-2.5 py-1 ml-1.5 rounded-full">
                                                <span>{{ round(count($rack->rackSpaces) /
                                                    $rack->rack_spaces_count *
                                                    100) }}%
                                                    Used</span>
                                            </span>

                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{$rack->description}}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{$rack->rack_spaces_count}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{$rack->location != null ? $rack->location->name : 'Uncategorized'}}
                                        </td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('colocation_manager.racks.show', $rack->id)}}">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $racks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>