<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Subnets') }}
        </h2>
    </x-slot>


    <div>
        <div class=" mx-auto ">

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

            <div class="flex justify-between">
                <x-primary-link href="{{route('ip_manager.subnets.create')}}" class="mb-2">
                    Add subnet +
                </x-primary-link>

                <form action="{{route('ip_manager.subnets.index')}}" class="flex gap-2 my-2">
                    <x-text-input name="search" placeholder="eg. Something LLC">
                    </x-text-input>
                    <x-primary-button type="submit">Search</x-primary-button>
                </form>
            </div>
            <div class="flex flex-col">
                <div class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                    <h2 class="text-xl font-semibold mb-4">Welcome to IP Manager (subnets)</h2>
                    <p class="text-gray-700">Here you can manage your subnets </p>
                    @if(count($subnets) < 1) <p class="text-gray-700">You have no subnets yet, click the button
                        above to get started</p>
                        @endif
                </div>
                <div class="overflow-x-auto mt-2">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-white">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Subnet Name</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Subnet</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">VLAN
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Leased Company
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Parent Subnet</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @if ($subnets->isEmpty())

                                    <tr class="bg-white text-neutral-500">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">No subnet found.
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        </td>
                                    </tr>
                                    @endif

                                    @foreach ($subnets as $subnet)
                                    <tr class="text-neutral-800 bg-white">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap flex items-center">
                                            {{$subnet->name}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{$subnet->subnet}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{$subnet->vlan}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{$subnet->leased_company}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            @if($subnet->parent != null)
                                            <a class="text-blue-800"
                                                href="{{route('ip_manager.subnets.show', $subnet->parent)}}">{{$subnet->parent->name}}
                                                &rarr;</a>
                                            @else
                                            None
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('ip_manager.subnets.show', $subnet->id)}}">View</a>
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
                {{ $subnets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>