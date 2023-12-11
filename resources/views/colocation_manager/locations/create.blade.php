<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new location') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add a new location') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Create a new location that you want to manage") }}
                    </p>
                </header>
                <form action="{{ route('colocation_manager.locations.store') }}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Location Name</label>
                        <x-text-input name="name" label="location Name" placeholder="e.g. location 1"
                            value="{{old('name')}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold">Location Description</label>
                        <x-text-input name="description" label="location Description"
                            placeholder="e.g. Very cool location" value="{{old('description')}}" />
                        @error('description')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tlocationing-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Add location +</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>