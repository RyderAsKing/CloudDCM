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
                            <label for="name" class="font-bold">Name*</label>
                            <x-text-input name="name" label="Company Name" placeholder="e.g. Dallas Main Subnet"
                                value="{{old('name')}}" />
                            @error('name')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="subnet" class="font-bold">Subnet</label>
                            <x-text-input name="subnet" label="Phone" placeholder="e.g. +1 824739921"
                                value="{{old('subnet')}}" />
                            @error('subnet')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="vlan" class="font-bold">VLAN</label>
                            <x-text-input name="vlan" label="URL" placeholder="e.g. example.com"
                                value="{{old('vlan')}}" />
                            @error('vlan')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="leased_company" class="font-bold">Leased Company</label>
                            <x-text-input name="leased_company" label="URL" placeholder="e.g. example.com"
                                value="{{old('leased_company')}}" />
                            @error('leased_company')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                        <div class="flex flex-col mt-2">
                            <label for="parent_id" class="font-bold">Parent Subnet</label>
                            <select id="parent_id" name="parent_id" style="width: 100%;">
                                <option value=" ">None</option>
                                @foreach ($subnets as $subnet)
                                <option value="{{$subnet->id}}">{{$subnet->name}} | {{$subnet->subnet}}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
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