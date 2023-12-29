<aside
    class="fixed flex flex-col w-60 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700 ">
    <a href="{{route('dashboard')}}" class="w-full">
        <x-application-logo class="w-full h-20 mx-auto text-gray-600" />
    </a>
    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav class="-mx-3 space-y-6 ">
            <div class="space-y-3 ">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">general</label>
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('dashboard')}}">
                    <span class="mx-2 text-sm font-medium">Dashboard</span>
                </a>
            </div>

            @hasanyrole('user|subuser')
            <div class="space-y-3 ">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">modules</label>

                @hasrole('colocation_manager')

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('colocation_manager.locations.index')}}">

                    <span class="mx-2 text-sm font-medium">Colocation Manager</span>
                </a>
                @endhasrole

                @hasrole('customer_relationship_manager')
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('customer_relationship_manager.customers.index')}}">

                    <span class="mx-2 text-sm font-medium">Customer Relationship (CRM)</span>
                </a>
                @endhasrole

                @hasrole('vps_manager')
                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('vps_manager.locations.index')}}">

                    <span class="mx-2 text-sm font-medium">VPS Manager</span>
                </a>
                @endhasrole
            </div>
            @endhasanyrole

            @hasanyrole('admin|user')
            <div class="space-y-3 ">
                <label class="px-3 text-xs text-gray-500 uppercase dark:text-gray-400">configuration</label>

                <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                    href="{{route('users.index')}}">

                    <span class="mx-2 text-sm font-medium">Users</span>
                </a>
            </div>
            @endhasanyrole
        </nav>
    </div>

    <div class="justify-end mb-3 w-full">
        <x-dropdown align="top" width="100%">
            <x-slot name="trigger">
                <button
                    class="w-full inline-flex items-center px-4 py-4 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div>
                        {{ Auth::user()->name }}
                        @hasrole('user')
                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">user</span>
                        @endhasrole

                        @hasrole('subuser')

                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">subuser</span>
                        @endhasrole

                        @hasrole('admin')
                        <span
                            class="bg-blue-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">admin</span>
                        @endhasrole
                    </div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</aside>