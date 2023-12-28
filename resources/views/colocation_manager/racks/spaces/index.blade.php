<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editing a rack space') }}
            </h2>

            <form method="post"
                action="{{route('colocation_manager.racks.spaces.destroy', [$rack->id, $rackSpace->unit_number])}}">
                @csrf
                @method('DELETE')
                <x-primary-button type="submit" class="bg-red-500 hover:bg-red-600">
                    Delete X
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div>

        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-xl p-8 rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Editing unit rack space ' . $rackSpace->unit_number) }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Update information about the unit rack space.") }}
                    </p>
                </header>
                <form action="{{route('colocation_manager.racks.spaces.update', [$rack->id, $rackSpace->unit_number])}}"
                    method="POST" class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Name</label>

                        <x-text-input name="name" label="Name" placeholder="e.g. dal.xyz.com"
                            value="{{$rackSpace->name ?? ''}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold"> Description</label>

                        <x-text-input name="description" label="Description"
                            placeholder="e.g. This server is used for ..." value="{{$rackSpace->description ?? ''}}" />
                        @error('description')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="client_email" class="font-bold"> Client Email</label>
                        <x-text-input type="email" name="client_email" label="Client Email"
                            placeholder="e.g. admin@example.com" value="{{$rackSpace->client_email ?? ''}}" />
                        @error('client_email')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="client_id" class="font-bold"> Client ID</label>
                        <x-text-input type="number" name="client_id" label="Client ID" placeholder="e.g. 123"
                            value="{{$rackSpace->client_id ?? ''}}" />
                        @error('client_id')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="hardware_type" class="font-bold"> Hardware Type/Model</label>
                        <x-text-input name="hardware_type" label="Hardware Type/Model" placeholder="e.g. HP DL380 G7"
                            value="{{$rackSpace->hardware_type ?? ''}}" />
                        @error('hardware_type')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="ipmi_port" class="font-bold"> IPMI Port</label>
                        <x-text-input name="ipmi_port" label="IPMI Port" placeholder="e.g. Port 0/14, WAN: 0/39"
                            value="{{$rackSpace->ipmi_port ?? ''}}" />
                        @error('ipmi_port')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="switch_port" class="font-bold"> Switch Port</label>
                        <x-text-input name="switch_port" label="Switch Port" placeholder="e.g. Port 0/14"
                            value="{{$rackSpace->switch_port ?? ''}}" />
                        @error('switch_port')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="subnet" class="font-bold"> Subnet</label>
                        <x-text-input name="subnet" label="Subnet" placeholder="e.g. 127.0.0.1/24"
                            value="{{$rackSpace->subnet ?? ''}}" />
                        @error('subnet')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Update &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>