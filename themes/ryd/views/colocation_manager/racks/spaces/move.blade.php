<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Move/Swap a rack space') }}
            </h2>

        </div>
    </x-slot>

    <div>

        <div class="mx-auto ">
            <div class="bg-white overflow-hidden shadow-xl p-8 rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Moving unit rack space ' . $rackSpace->unit_number) }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Swap/Move the details of current unit rack space with another unit rack space.") }}
                    </p>
                </header>
                <form action="{{route('colocation_manager.racks.spaces.move', [$rack->id, $rackSpace->unit_number])}}"
                    method="POST" class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf

                    <h3 class="mb-5 text-lg font-medium text-gray-900 ">Select the rack space you want to move/swap
                        below </h3>
                    <ul class="flex flex-col gap-1">
                        @foreach ($rack->rackSpaces->reverse() as $rackSpace)
                        <li>
                            <input type="radio" id="{{$rackSpace->unit_number}}" name="moveto"
                                value="{{$rackSpace->unit_number}}" class="hidden peer" required>
                            <label for="{{$rackSpace->unit_number}}"
                                class="inline-flex items-center justify-between w-full px-6 py-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                                <div class="w-full flex gap-2 items-center justify-between">
                                    <div class="text-lg font-semibold">#{{$rackSpace->unit_number}}</div>
                                    <div>@if($rackSpace->name !=
                                        null) {{
                                        $rackSpace->name }} @else
                                        Not assigned @endif</div>

                                    <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </div>

                            </label>
                        </li>
                        @endforeach

                    </ul>
                    {{-- <div class="rack rounded-xl bg-gray-200"
                        style="display: flex; flex-direction: column; gap: .1rem; border: 1px solid #200; padding: .5rem; height: fit-content;">
                        <p>Server Rack: {{$rack->name}}</p>
                        @foreach ($rack->rackSpaces->reverse() as $rackSpace)
                        <div class="rack-unit bg-gray-900 text-white flex justify-between text-xs"
                            style="padding: .5rem">

                            <span>#{{$rackSpace->unit_number}}</span><span>@if($rackSpace->name !=
                                null) {{
                                $rackSpace->name }} @else
                                Not assigned @endif</span>
                            <div>
                                @if($rackSpace->name !=
                                null) <span class="bg-green-500"
                                    style="display: inline-block; height: 12px; width: 12px; border-radius: 50%"></span>
                                @else
                                <span class="bg-red-500"
                                    style="display: inline-block; height: 12px; width: 12px; border-radius: 50%"></span>
                                @endif
                                </td>
                            </div>
                        </div>
                        @endforeach
                    </div> --}}

                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Move &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>