<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a Subnet') }}
        </h2>
    </x-slot>

    <div>
        <div class=" mx-auto ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add a Subnet') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Create a subnet that you want to manage") }}
                    </p>
                </header>
                <form action="{{ route('ip_manager.subnets.store') }}" method="POST" class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div>
                        <div class="flex flex-col mt-2">
                            <label for="company_name" class="font-bold">Name*</label>
                            <x-text-input name="company_name" label="Company Name" placeholder="e.g. Example LLC"
                                value="{{old('company_name')}}" />
                            @error('company_name')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="phone" class="font-bold">Subnet</label>
                            <x-text-input name="phone" label="Phone" placeholder="e.g. +1 824739921"
                                value="{{old('phone')}}" />
                            @error('phone')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="website" class="font-bold">VLAN</label>
                            <x-text-input name="url" label="URL" placeholder="e.g. example.com"
                                value="{{old('url')}}" />
                            @error('url')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="website" class="font-bold">VLAN</label>
                            <x-text-input name="url" label="URL" placeholder="e.g. example.com"
                                value="{{old('url')}}" />
                            @error('url')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="website" class="font-bold">VLAN</label>
                            <x-text-input name="url" label="URL" placeholder="e.g. example.com"
                                value="{{old('url')}}" />
                            @error('url')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                    </div>

                    <x-primary-button type="submit" class="mt-2" style="width: fit-content;">Add Subnet +
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>