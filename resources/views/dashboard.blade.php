<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="">
                        <!-- Card 1 -->
                        <div class="backdrop-blur-sm bg-white/20 p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                            <h2 class="text-xl font-semibold mb-4">Welcome to dashboard</h2>
                            <p class="text-gray-700">Here you can manage colocation rack space with ease</p>

                            <a href="{{ route('racks.index') }}"
                                class="mt-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">Manage
                                now
                                &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-4  bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                            <a href="#_" class="block mb-3">
                                <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Card Title
                                </h5>
                            </a>
                            <p class="mb-4 text-neutral-500">Here are the biggest enterprise technology acquisitions of
                                2021
                                so far, in reverse
                                chronological order.</p>
                            <button
                                class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                                <span>Card Button</span>
                                <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="mt-4  bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                            <a href="#_" class="block mb-3">
                                <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Card Title
                                </h5>
                            </a>
                            <p class="mb-4 text-neutral-500">Here are the biggest enterprise technology acquisitions of
                                2021
                                so far, in reverse
                                chronological order.</p>
                            <button
                                class="inline-flex items-center justify-between w-auto h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">
                                <span>Card Button</span>
                                <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>