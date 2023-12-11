<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing rack ' . $rack->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Editing rack') }}
                    </h2>

                </header>
                <form action="{{ route('colocation_manager.racks.update', $rack) }}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Rack Name</label>
                        <x-text-input name="name" label="Rack Name" placeholder="e.g. Rack 1" value="{{$rack->name}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold">Rack Description</label>
                        <x-text-input name="description" label="Rack Description" placeholder="e.g. Very cool rack"
                            value="{{$rack->description}}" />
                        @error('description')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="rack_size" class="font-bold">Location</label>
                        <select name="location" id="location">
                            <option value=" " @if($rack->location_id == null) selected @endif>Uncategorized</option>
                            @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @if($rack->location_id == $location->id) selected
                                @endif>{{
                                $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Edit Rack &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>