<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray leading-tight">
            {{ __('Viewing customer: ' . $customer->company_name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60 mb-2">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900 mb-1">
                            {{$customer->contact_name}}
                            <span
                                class="bg-gray-900 text-gray-200 text-sm font-semibold px-2.5 py-0.5 rounded-full ">{{$customer->company_name}}</span>
                        </h5>


                        <p>Status:
                            @switch($customer->status)
                            @case('potential')
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Potential</span>
                            @break
                            @case('active')
                            <span
                                class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Active</span>
                            @break
                            @case('cancelled')
                            <span
                                class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Cancelled</span>
                            @break
                            @case('not_interested')
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Not
                                Interested</span>
                            @break
                            @case('contacted')
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Contacted</span>
                            @break
                            @default
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Unkown</span>
                            @endswitch
                        </p>

                        @if(isset($customer->url))
                        <a href="{{$customer->url}}">Website:
                            <span class="hover:text-blue-900 underline">{{$customer->url}}</span></a>
                        @endif
                        <div class="flex gap-2 ">
                            <p>Customer created {{$customer->created_at->diffForHumans()}}</p><span>-</span>
                            <p>Customer updated {{$customer->updated_at->diffForHumans()}}</p>
                        </div>
                    </div>
                    <div>
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900 mb-1">
                            Address
                        </h5>
                        @if(isset($customer->email))<a href="mailto:{{$customer->email}}">{{$customer->email}}</a>@endif
                        @if(isset($customer->address))<p class=" text-neutral-500">{{$customer->address}}
                        </p>@endif
                        @if(isset($customer->city))<p class=" text-neutral-500">{{$customer->city}}
                        </p>@endif
                        @if(isset($customer->phone))<a href="tel:{{$customer->phone}}" class="mb-4 text-neutral-500">
                            {{$customer->phone}}@endif
                        </a>
                    </div>

                </div>
                <hr class="my-2">
                <div class="grid grid-cols-2 gap-2 items-center">
                    <div>
                        <ul>
                            @if(isset($customer->num_desktops))<li>Number of Desktops: {{$customer->num_desktops}}</li>
                            @endif
                            @if(isset($customer->num_notebooks))<li>Number of Notebooks: {{$customer->num_notebooks}}
                            </li>@endif
                            @if(isset($customer->num_printers))<li>Number of Printers: {{$customer->num_printers}}</li>
                            @endif
                            @if(isset($customer->num_servers))<li>Number of Servers: {{$customer->num_servers}}</li>
                            @endif
                            @if(isset($customer->num_firewalls))<li>Number of Firewalls: {{$customer->num_firewalls}}
                            </li>@endif
                            @if(isset($customer->num_wifi_access_points))<li>Number of Wifi Access Points:
                                {{$customer->num_wifi_access_points}}</li>@endif
                            @if(isset($customer->num_switches))<li>Number of Switches: {{$customer->num_switches}}</li>
                            @endif

                        </ul>
                    </div>

                    @if(isset($customer->notes))
                    <div>
                        <span class="font-bold">Notes:</span>
                        <code>{{Str::limit($customer->notes, 2000)}}</code>
                    </div>
                    @endif
                </div>

                @if(isset($customer->quote_provided))
                <div class="text-3xl mt-2">Quote Provided: <strong>{{$customer->quote_provided}}</strong></div>
                @endif

                <div class="my-4 flex gap-2">
                    <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                        :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
                        <a href="{{route('customer_relationship_manager.customers.edit', $customer)}}"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-neutral-950 rounded-md  focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">Edit
                            Customer &rarr;</a>
                        <button @click="modalOpen=true"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">Delete
                            &cross;</button>
                        <template x-teleport=" body">
                            <div x-show="modalOpen"
                                class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                x-cloak>
                                <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0" @click="modalOpen=false"
                                    class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
                                </div>
                                <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-90"
                                    class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                                    <div class="flex items-center justify-between pb-3">
                                        <h3 class="text-lg font-semibold">Delete customer?</h3>
                                        <button @click="modalOpen=false"
                                            class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative w-auto pb-8">
                                        <p>This action cannot be undone. Are you sure you want to delete this
                                            customer?</p>
                                    </div>
                                    <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                                        <button @click="modalOpen=false" type="button"
                                            class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">
                                            Go back &larr;
                                        </button>
                                        <form
                                            action="{{route('customer_relationship_manager.customers.destroy', $customer->id)}}"
                                            method="post">
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
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>