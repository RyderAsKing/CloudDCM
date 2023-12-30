<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class=" mx-auto ">
            <div class=" text-gray-900">
                {{-- total count of users --}}
                <x-user.widget :users="$users" />

                {{-- colocationManager['locations'] = collection of locations with racks,
                colocationManager['locations']['uncategorizied'] = total number of racks without
                a location, $colocationManager['racks'] = total number of racks, $colocationManager['rackSpaces'] =
                total number of rackSpaces --}}

                <x-colocation_manager.widget :colocation_manager="$colocation_manager" />

                <x-vps_manager.widget :vps_manager="$vps_manager" />

                <x-customer_relationship_manager.widget
                    :customer_relationship_manager="$customer_relationship_manager" />

            </div>
        </div>
</x-app-layout>