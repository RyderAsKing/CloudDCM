<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new rack') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- ask user to input rack name, description, and rack size. everything should be styled using tailwind --}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-4">
                <form action="{{ route('racks.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Rack Name</label>
                        <input type="text" name="name" id="name" placeholder="e.g. Rack 1"
                            class="border border-gray-300 p-2 mt-1 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            value={{old('name')}}>
                        @error('name')
                        <div class="mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold">Rack Description</label>
                        <input type="text" name="description" id="description" placeholder="e.g. Very cool rack"
                            class="border border-gray-300 p-2 mt-1 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            value={{old('description')}}>
                        @error('description')
                        <div class="mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="rack_size" class="font-bold">Rack Size</label>
                        <input type="number" name="rack_size" id="rack_size" placeholder="eg 42"
                            class="border border-gray-300 p-2 mt-1 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            value={{old('rack_space')}}>
                        @error('rack_size')
                        <div class="mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-2 flex items-center bg-white from-violet-300 to-indigo-300  border border-fuchsia-00 hover:border-violet-100 font-semibold py-2 px-4 rounded-md transition-colors duration-300"
                        style="width: fit-content;">Add Rack</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>