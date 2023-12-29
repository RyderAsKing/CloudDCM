<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new vps') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add a new vps') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Create a new vps that you want to manage") }}
                    </p>
                </header>
                <form action="{{ route('vps_manager.vpss.store') }}" method="POST" class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Hostname</label>
                        <x-text-input name="name" label="Hostname" placeholder="e.g. vps 1" value="{{old('name')}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold">IP address</label>
                        <x-text-input name="ip_address" label="IP address" placeholder="e.g. Very cool vps"
                            value="{{old('description')}}" />
                        @error('description')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="vps_size" class="font-bold">Username</label>
                        <x-text-input type="number" name="username" label="User" placeholder="eg 42"
                            value="{{old('vps_size')}}" />
                        @error('vps_size')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="vps_size" class="font-bold">Password</label>
                        <x-text-input name="password" label="User" placeholder="eg VeryStrongPass12#$"
                            value="{{old('vps_size')}}" />
                        @error('vps_size')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="vps_size" class="font-bold">Location</label>
                        <select name="location" id="location">
                            <option value=" ">Uncategorized</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <x-primary-button class="mt-2" style="width: fit-content;">Add vps +</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>