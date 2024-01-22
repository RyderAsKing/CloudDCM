<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing a user') }}
        </h2>
    </x-slot>

    <div>

        <div class=" mx-auto ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Editing ' . $user->email) }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Update account's profile information and email address.") }}
                    </p>
                </header>
                <form action="{{route('users.update', [$user->id])}}" method="POST" class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Name</label>
                        <input type="text" name="name" id="name" placeholder="e.g. John Doe"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value='{{$user->name}}'>
                        @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="email" class="font-bold">Email</label>
                        <input type="email" name="email" id="email" placeholder="e.g. admin@example.com"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                            value='{{$user->email}}'>
                        @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="password" class="font-bold">Password</label>
                        <input autocomplete="new-password" type="password" name="password" id="password"
                            placeholder="e.g. I23VeryCool@#"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                        @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    @if($user->hasRole('subuser'))
                    <div class="flex flex-col mt-2">
                        <label for="roles" class="font-bold">Permissions</label>
                        <select class="roles-selector" name="permissions[]" multiple="multiple">
                            @foreach($permissions as $permission)
                            <option value="{{$permission->name}}" @if($user->can($permission->name)) selected
                                @endif>{{$permission->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('roles')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif

                    @hasanyrole('admin|user')
                    <h3 class="mt-2">Modules</h3>
                    @can('edit-modules', 'colocation_manager')
                    <div class="flex flex-row items-center gap-2">
                        <input type="checkbox" id="colocation_manager" name="colocation_manager"
                            @if($user->hasRole('colocation_manager')) checked @endif">
                        <label for="colocation_manager"> Colocation Manager</label>
                    </div>
                    @endcan

                    @can('edit-modules', 'customer_relationship_manager')
                    <div class="flex flex-row items-center gap-2">
                        <input type="checkbox" id="customer_relationship_manager" name="customer_relationship_manager"
                            @if($user->hasRole('customer_relationship_manager')) checked @endif>
                        <label for=" customer_relationship_manager"> Customer Relationship Manager</label><br>
                    </div>
                    @endcan



                    @can('edit-modules', 'vps_manager')
                    <div class="flex flex-row items-center gap-2">
                        <input type="checkbox" id="vps_manager" name="vps_manager" @if($user->hasRole('vps_manager'))
                        checked @endif>
                        <label for="vps_manager"> VPS Manager</label><br>
                    </div>
                    @endcan

                    @can('edit-modules', 'ip_manager')
                    <div class="flex flex-row items-center gap-2">
                        <input type="checkbox" id="ip_manager" name="ip_manager" @if($user->hasRole('ip_manager'))
                        checked @endif>
                        <label for="ip_manager"> IP Manager</label><br>
                    </div>
                    @endcan

                    @can('edit-modules', 'dedicated_server_manager')
                    <div class="flex flex-row items-center gap-2">
                        <input type="checkbox" id="dedicated_server_manager" name="dedicated_server_manager"
                            @if($user->hasRole('dedicated_server_manager')) checked @endif>
                        <label for="dedicated_server_manager"> Dedicated Server Manager</label><br>
                    </div>
                    @endcan
                    @endhasanyrole


                    <div class="flex justify-between">
                        <x-primary-button class="mt-2" style="width: fit-content;">Update &rarr;</x-primary-button>

                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                            :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">
                            <x-danger-button @click="modalOpen=true" type="button"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                Delete
                                &cross;</x-danger-button>
                            <template x-teleport="body">
                                <div x-show="modalOpen"
                                    class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                    x-cloak>
                                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0" @click="modalOpen=false"
                                        class="absolute inset-0 w-full h-full bg-gray-900 bg-opacity-50 backdrop-blur-sm">
                                    </div>
                                    <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                        x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-90"
                                        class="relative w-full py-6 bg-white shadow-md px-7 bg-opacity-90 drop-shadow-md backdrop-blur-sm sm:max-w-lg sm:rounded-lg">
                                        <div class="flex items-center justify-between pb-3">
                                            <h3 class="text-lg font-semibold">Delete user?</h3>
                                            <button @click="modalOpen=false"
                                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="relative w-auto pb-8">
                                            <p>This action cannot be undone. Are you sure you want to delete this user?
                                            </p>
                                        </div>
                                        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-2">
                                            <button @click="modalOpen=false" type="button"
                                                class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">
                                                Go back &larr;
                                            </button>
                                            <form action="{{route('users.destroy', $user)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                                    Yes &cross;
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        $('.roles-selector').select2();
        });
    </script>
</x-app-layout>