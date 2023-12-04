<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new user') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Create a new user ') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Create a new user account.") }}
                    </p>
                </header>
                <form action="{{ route('users.store') }}" method="POST" class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Name</label>

                        <x-text-input name="name" label="Name" placeholder="e.g. John Doe" value="{{old('name')}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="email" class="font-bold">Email</label>

                        <x-text-input name="email" label="Email" placeholder="e.g. admin@example.com "
                            value="{{old('email')}}" />
                        @error('email')
                        <x-input-error :messages=" $message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="password" class="font-bold">Password</label>

                        <x-text-input type="password" name="password" label="Password" placeholder="e.g. I23VeryCool@#"
                            autocomplete="new-password" />
                        @error('password')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    @hasrole('admin')
                    <div class="flex flex-col mt-2">
                        <label for="owner_id" class="font-bold">Owner of the user <span
                                class="text-xs text-gray-500">only enter
                                if you want this user to be a subuser</span></label>
                        <input type="hidden" name="owner_id" id="owner_id" placeholder="eg 52"
                            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                        <select id="owner-search" style="width: 100%;">
                            <option value="none">None</option>
                        </select>
                        @error('owner_id')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    @endhasrole

                    @hasanyrole('admin|user')


                    <h3 class="mt-2">Modules</h3>
                    @can('edit-modules', 'colocation_manager')
                    <div class="flex flex-row items-center gap-2">
                        <input type="checkbox" id="colocation_manager" name="colocation_manager"
                            @if($user->hasRole('colocation_manager'))
                        checked @endif">
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
                    @endhasanyrole


                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Create user +</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#owner-search').select2({
            ajax: {
                url: '/search-user',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term,
                    };
                },
                processResults: function (data) {
                    data.unshift({ id: ' ', text: 'None' });
                    return {
                        results: data,
                    };
                },
                cache: true,
            },
            placeholder: 'Search for an owner...',
        });

        $('#owner-search').on('select2:select', function (e) {
            var selectedData = e.params.data;
            $('#owner_id').val(selectedData.id);
        });
    </script>
</x-app-layout>