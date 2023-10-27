<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing a rack space') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-8 rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Editing unit rack space ' . $rackSpace->unit_number) }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Update information about the unit rack space.") }}
                    </p>
                </header>
                <form action="{{route('racks.spaces.update', [$rack->id, $rackSpace->unit_number])}}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Name</label>
                        <input type="text" name="name" id="name" placeholder="e.g. dal.xyz.com"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->name != null) {{$rackSpace->name}} @endif">
                        @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold"> Description</label>
                        <input type="text" name="description" id="description"
                            placeholder="e.g. This server is used for ..."
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->description != null) {{$rackSpace->description}} @endif">
                        @error('description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="client_email" class="font-bold"> Client Email</label>
                        <input type="text" name="client_email" id="client_email" placeholder="e.g. admin@example.com"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->client_email != null) {{$rackSpace->client_email}} @endif">
                        @error('client_email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="client_id" class="font-bold"> Client ID</label>
                        <input type="number" name="client_id" id="client_id" placeholder="e.g. 123"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->client_id != null){{$rackSpace->client_id}}@endif">
                        @error('client_id')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="hardware_type" class="font-bold"> Hardware Type/Model</label>
                        <input type="text" name="hardware_type" id="hardware_type" placeholder="e.g. HP DL380 G7"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->hardware_type != null) {{$rackSpace->hardware_type}} @endif">
                        @error('hardware_type')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="ipmi_port" class="font-bold"> IPMI Port</label>
                        <input type="text" name="ipmi_port" id="ipmi_port" placeholder="e.g. Port 0/14, WAN: 0/39"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->ipmi_port != null) {{$rackSpace->ipmi_port}} @endif">
                        @error('ipmi_port')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="switch_port" class="font-bold"> Switch Port</label>
                        <input type="text" name="switch_port" id="switch_port" placeholder="e.g. Port 0/14"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->switch_port != null) {{$rackSpace->switch_port}} @endif">
                        @error('switch_port')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="subnet" class="font-bold"> Subnet</label>
                        <input type="text" name="subnet" id="subnet" placeholder="e.g. 127.0.0.1/24"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value="@if($rackSpace->subnet != null) {{$rackSpace->subnet}} @endif">
                        @error('subnet')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
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