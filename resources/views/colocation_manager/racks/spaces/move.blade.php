<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Move/Swap a rack space') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-8 rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Moving unit rack space ' . $rackSpace->unit_number) }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Swap/Move the details of current unit rack space with another unit rack space.") }}
                    </p>
                </header>
                <form action="{{route('colocation_manager.racks.spaces.update', [$rack->id, $rackSpace->unit_number])}}"
                    method="POST" class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf

                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Move &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>