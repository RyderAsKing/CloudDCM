<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing vps ' . $vps->name) }}
        </h2>
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

                    <x-primary-button class="mt-2" style="width: fit-content;">Edit vps &rarr;</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>