<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editing vps ' . $vps->hostname) }}
            </h2>

            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" :class="{ 'z-40': modalOpen }"
                class="relative w-auto h-auto">
                <button @click="modalOpen=true"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">Delete
                    &cross;</button>
                <template x-teleport=" body">
                    <div x-show="modalOpen"
                        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" @click="modalOpen=false"
                            class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
                        </div>
                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                            class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                            <div class="flex items-center justify-between pb-3">
                                <h3 class="text-lg font-semibold">Delete VPS?</h3>
                                <button @click="modalOpen=false"
                                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="relative w-auto pb-8">
                                <p>This action cannot be undone. Are you sure you want to delete this
                                    VPS?</p>
                            </div>
                            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                                <button @click="modalOpen=false" type="button"
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">
                                    Go back &larr;
                                </button>
                                <form action="{{route('vps_manager.vpss.destroy', $vps->id)}}" method="post">
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

    <div>
        <div class=" mx-auto ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Editing vps') }}
                    </h2>

                </header>
                <form action="{{ route('vps_manager.vpss.update', $vps) }}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col">
                        <label for="hostname" class="font-bold">Hostname</label>
                        <x-text-input name="hostname" label="Hostname" placeholder="e.g. Something.com"
                            value="{{$vps->hostname}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="ip_address" class="font-bold">IP address</label>
                        <x-text-input name="ip_address" label="IP address" placeholder="e.g. 192.168.0.1"
                            value="{{$vps->ip_address}}" />
                        @error('ip_address')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="username" class="font-bold">Username</label>
                        <x-text-input type="text" name="username" label="User" placeholder="eg 42"
                            value="{{$vps->username}}" />
                        @error('username')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="password" class="font-bold">Password</label>
                        <x-text-input name="password" label="User" placeholder="eg VeryStrongPass12#$"
                            value="{{$vps->password}}" />
                        @error('password')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="vps_size" class="font-bold">Location</label>
                        <select name="location_id" id="location_id">
                            <option value=" " @if($vps->location_id == null) selected @endif>Uncategorized</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @if($vps->location_id == $location->id) selected
                                @endif>{{
                                $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <hr>
                    <div class="grid grid-cols-3 gap-2">
                        <h3 class="text-md font-bold col-span-3 mt-2">Specifications</h3>
                        <div class="flex flex-col ">
                            <label for="cpu" class="font-bold">CPU (vCores)</label>

                            <select name="cpu" id="cpu"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value=" ">Unkown</option>
                                @for($i = 1; $i < 17; $i++) <option value="{{ $i }}" @if($vps->cpu == $i) selected
                                    @endif>{{ $i }}</option>
                                    @endfor
                            </select>
                            @error('cpu')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col ">
                            <label for="memory" class="font-bold">Memory</label>
                            <x-text-input name="memory" label="Memory" placeholder="eg 4 GB" value="{{$vps->memory}}" />
                            @error('memory')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col ">
                            <label for="storage" class="font-bold">Storage</label>
                            <x-text-input name="storage" label="Storage" placeholder="eg 100 GB"
                                value="{{$vps->storage}}" />
                            @error('storage')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                    </div>
                    <x-primary-button class="mt-2" style="width: fit-content;">Edit vps &rarr;</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>