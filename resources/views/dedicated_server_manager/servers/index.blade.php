<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing servers') }}
        </h2>
    </x-slot>

    {{-- loop through servers and display all servers in a nice formatted table with options to view edit and delete.
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

            <x-primary-link href="{{route('dedicated_server_manager.servers.create')}}" class="mb-2">
                Add vps +
            </x-primary-link>
            <div class="flex flex-col">

                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-white">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Hostname</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">IP Address
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Username
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Password
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Location
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @if ($servers->isEmpty())

                                    <tr class="bg-white text-neutral-500">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">No server's found.
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        </td>
                                    </tr>
                                    @endif

                                    @foreach ($servers as $server)
                                    <tr class="text-neutral-800 bg-white">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap flex items-center">
                                            {{$server->hostname}}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{$server->ip_address}}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            <div x-data="{
                                                    copyText: '{{$server->username}}',
                                                    copyNotification: false,
                                                    copyToClipboard() {
                                                        navigator.clipboard.writeText(this.copyText);
                                                        this.copyNotification = true;
                                                        let that = this;
                                                        setTimeout(function(){
                                                            that.copyNotification = false;
                                                        }, 3000);
                                                    }
                                                }" class="relative z-20 flex items-center">
                                                <button @click="copyToClipboard();"
                                                    class="flex items-center justify-center w-auto h-8 px-3 py-1 text-xs bg-white border rounded-md cursor-pointer border-neutral-200/60 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none text-neutral-500 hover:text-neutral-600 group">
                                                    <span x-show="!copyNotification">{{$server->username}} </span>
                                                    <svg x-show="!copyNotification"
                                                        class="w-4 h-4 ml-1.5 stroke-current"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                    </svg>
                                                    <span x-show="copyNotification"
                                                        class="tracking-tight text-green-500"
                                                        x-cloak>{{$server->username}}
                                                    </span>
                                                    <svg x-show="copyNotification"
                                                        class="w-4 h-4 ml-1.5 text-green-500 stroke-current"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        x-cloak>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            <div x-data="{
                                                    copyText: '{{$server->password}}',
                                                    copyNotification: false,
                                                    copyToClipboard() {
                                                        navigator.clipboard.writeText(this.copyText);
                                                        this.copyNotification = true;
                                                        let that = this;
                                                        setTimeout(function(){
                                                            that.copyNotification = false;
                                                        }, 3000);
                                                    }
                                                }" class="relative z-20 flex items-center">
                                                <button @click="copyToClipboard();"
                                                    class="flex items-center justify-center w-auto h-8 px-3 py-1 text-xs bg-white border rounded-md cursor-pointer border-neutral-200/60 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none text-neutral-500 hover:text-neutral-600 group">
                                                    <span x-show="!copyNotification">{{Str::limit($server->password,
                                                        5)}} </span>
                                                    <svg x-show="!copyNotification"
                                                        class="w-4 h-4 ml-1.5 stroke-current"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                                    </svg>
                                                    <span x-show="copyNotification"
                                                        class="tracking-tight text-green-500"
                                                        x-cloak>{{Str::limit($server->password,
                                                        5)}} </span>
                                                    <svg x-show="copyNotification"
                                                        class="w-4 h-4 ml-1.5 text-green-500 stroke-current"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        x-cloak>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{$server->location != null ?
                                            $server->location->name : 'Uncategorized'}}</td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('dedicated_server_manager.servers.edit', $server)}}">Edit</a>
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
                {{ $servers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>