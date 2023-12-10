<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 text-gray-900">
                    {{-- total count of users --}}
                    <x-user.widget :users="$users" />

                    {{-- colocationManager['locations'] = collection of locations with racks,
                    colocationManager['locations']['uncategorizied'] = total number of racks without
                    a location, $colocationManager['racks'] = total number of racks, $colocationManager['rackSpaces'] =
                    total number of rackSpaces --}}

                    <x-colocation_manager.widget :colocation_manager="$colocation_manager" />
                </div>
            </div>
        </div>
</x-app-layout>