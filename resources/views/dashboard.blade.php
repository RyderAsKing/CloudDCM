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
                    <div class="grid grid-cols-1 ">
                        <!-- Card 1 -->
                        <div
                            class="backdrop-blur-sm bg-white/20 p-6 rounded-md shadow-sm cursor-pointer border-2 border-gray-50 hover:border-violet-200 hover:border-2 transition-colors duration-300">
                            <h2 class="text-xl font-semibold mb-4">Welcome to dashboard</h2>
                            <p class="text-gray-700">Here you can manage colocation rack space with ease</p>

                            <a href="#"
                                class="mt-2 flex items-center bg-gradient-to-r from-violet-300 to-indigo-300  border border-fuchsia-00 hover:border-violet-100 font-semibold py-2 px-4 rounded-md transition-colors duration-300"
                                style="width: fit-content;">Manage
                                now
                                &rarr;
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>