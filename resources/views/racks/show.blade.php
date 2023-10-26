<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Managing rack {{$rack->name}}
            </h2>

            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" :class="{ 'z-40': modalOpen }"
                class="relative w-auto h-auto">
                <button @click="modalOpen=true"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">Delete
                    &cross;</button>
                <template x-teleport="body">
                    <div x-show="modalOpen"
                        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" @click="modalOpen=false"
                            class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm"></div>
                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                            class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                            <div class="flex items-center justify-between pb-3">
                                <h3 class="text-lg font-semibold">Modal Title</h3>
                                <button @click="modalOpen=false"
                                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="relative w-auto pb-8">
                                <p>This action cannot be undone. Are you sure you want to delete this rack?</p>
                            </div>
                            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                                <button @click="modalOpen=false" type="button"
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">
                                    Go back &larr;
                                </button>
                                <form action="{{route('racks.destroy', $rack)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                        Yes &cross;
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="grid grid-cols-5 gap-2 mx-auto sm:px-6 lg:px-8">
            <div class="rack rounded-xl bg-gray-200"
                style="display: flex; flex-direction: column; gap: .1rem; border: 1px solid #200; padding: .5rem; height: fit-content;">
                <p>Server Rack: {{$rack->name}}</p>
                @foreach ($rack->rackSpaces->reverse() as $rackSpace)
                <div class="rack-unit bg-gray-900 text-white flex justify-between text-xs" style="padding: .5rem">
                    <span><a class="hover:text-blue-300"
                            href="{{route('racks.spaces.show', [$rack->id, $rackSpace->unit_number])}}">#{{$rackSpace->unit_number}}
                            &rarr;</a></span><span>@if($rackSpace->name !=
                        null) {{
                        $rackSpace->name }} @else
                        Not assigned @endif</span>
                    <div>
                        @if($rackSpace->name !=
                        null) <span class="bg-green-500"
                            style="display: inline-block; height: 12px; width: 12px; border-radius: 50%"></span> @else
                        <span class="bg-red-500"
                            style="display: inline-block; height: 12px; width: 12px; border-radius: 50%"></span> @endif
                        </td>
                    </div>
                </div>
                @endforeach
            </div>
            <div style="grid-column: 2 / -1">
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

                <div class="flex flex-col">

                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full">
                            <div class="overflow-hidden border rounded-lg">
                                <table class="min-w-full divide-y divide-neutral-200">
                                    <thead class="bg-white">
                                        <tr class="text-neutral-500">
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">ID</th>
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Name
                                            </th>
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Description
                                            </th>
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Client
                                                Information
                                            </th>
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Hardware Type
                                            </th>
                                            <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-neutral-200">
                                        @foreach ($rack->rackSpaces->reverse() as $rackSpace)
                                        <tr class="text-neutral-800 bg-white">
                                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                                {{$rackSpace->unit_number}}
                                            </td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">@if($rackSpace->name !=
                                                null) {{
                                                $rackSpace->name }} @else
                                                Not assigned @endif</td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                                @if($rackSpace->description != null) {{
                                                $rackSpace->description }} @else
                                                Not assigned @endif
                                            </td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                                @if($rackSpace->client_id != null) {{
                                                $rackSpace->client_id }}@endif
                                                @if($rackSpace->client_email != null) {{
                                                $rackSpace->client_email }} @else
                                                Not assigned @endif </td>
                                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                                @if($rackSpace->hardware_type != null) {{
                                                $rackSpace->hardware_type }} @else
                                                Not assigned @endif
                                            </td>
                                            <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                <a class="text-blue-600 hover:text-blue-700"
                                                    href="{{route('racks.spaces.show', [$rack->id, $rackSpace->unit_number])}}">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>