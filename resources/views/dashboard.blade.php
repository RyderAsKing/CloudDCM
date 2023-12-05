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

                    {{-- locations = collection of locations with racks, uncategorizied = total number of racks without
                    a location, racks = total number of racks, rackSpaces = total number of rackSpaces --}}
                    <x-colocation_manager.widget :locations="$locations" :uncategorized="$uncategorized" :racks="$racks"
                        :rackSpaces="$rackSpaces" />
                </div>
            </div>
        </div>
</x-app-layout>