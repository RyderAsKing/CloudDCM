<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new server') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add a new server') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Create a new server that you want to manage") }}
                    </p>
                </header>
                <form action="{{ route('dedicated_server_manager.servers.store') }}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col">
                        <label for="hostname" class="font-bold">Hostname</label>
                        <x-text-input name="hostname" label="Hostname" placeholder="e.g. server 1"
                            value="{{old('name')}}" />
                        @error('hostname')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="ip_address" class="font-bold">IP address</label>
                        <x-text-input name="ip_address" label="IP address" placeholder="e.g. Very cool server"
                            value="{{old('ip_address')}}" />
                        @error('ip_address')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="username" class="font-bold">Username</label>
                        <x-text-input type="text" name="username" label="User" placeholder="eg root"
                            value="{{old('username')}}" />
                        @error('username')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="password" class="font-bold">Password</label>
                        <x-text-input name="password" label="User" placeholder="eg VeryStrongPass12#$"
                            value="{{old('password')}}" />
                        @error('password')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="location_id" class="font-bold">Location</label>
                        <select name="location_id" id="location_id"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value=" ">Uncategorized</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    {{-- cpu, memory and storage information --}}

                    <hr>
                    <div class="grid grid-cols-3 gap-2">
                        <h3 class="text-md font-bold col-span-3 mt-2">Specifications</h3>
                        <div class="flex flex-col ">
                            <label for="cpu" class="font-bold">CPU </label>

                            <select name="cpu" id="cpu"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value=" ">Unkown</option>
                                @for($i = 1; $i < 17; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                            @error('cpu')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col ">
                            <label for="memory" class="font-bold">Memory</label>
                            <x-text-input name="memory" label="Memory" placeholder="eg 4 GB"
                                value="{{old('memory')}}" />
                            @error('memory')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col ">
                            <label for="storage" class="font-bold">Storage</label>
                            <x-text-input name="storage" label="Storage" placeholder="eg 100 GB"
                                value="{{old('storage')}}" />
                            @error('storage')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col ">
                            <label for="os" class="font-bold">Operating System</label>
                            <x-text-input name="os" label="os" placeholder="eg Windows 11" value="{{old('os')}}" />
                            @error('os')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                    </div>

                    <x-primary-button class="mt-2" style="width: fit-content;">Add server +</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>