<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add a Customer') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Create a customer that you want to manage") }}
                    </p>
                </header>
                <form action="{{ route('customer_relationship_manager.customers.store') }}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col mt-2">
                        <label for="company_name" class="font-bold">Company Name*</label>
                        <x-text-input name="company_name" label="Company Name" placeholder="e.g. Example LLC"
                            value="{{old('company_name')}}" />
                        @error('company_name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="phone" class="font-bold">Phone</label>
                        <x-text-input name="phone" label="Phone" placeholder="e.g. +1 824739921"
                            value="{{old('phone')}}" />
                        @error('phone')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>


                    <div class="flex flex-col mt-2">
                        <label for="email" class="font-bold">Email</label>
                        <x-text-input name="email" label="Email" placeholder="e.g. someone@example.com"
                            value="{{old('email')}}" />
                        @error('email')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="contact_name" class="font-bold">Contact Name</label>
                        <x-text-input name="contact_name" label="Contact Name" placeholder="e.g. JOHN DOE"
                            value="{{old('contact_name')}}" />
                        @error('contact_name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="address" class="font-bold">Address</label>
                        <x-text-input name="address" label="Address" placeholder="e.g. 6-3-299/1, Padmarao Nagar"
                            value="{{old('address')}}" />
                        @error('address')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="city" class="font-bold">City</label>
                        <x-text-input name="city" label="City" placeholder="e.g. Dallas" value="{{old('city')}}" />
                        @error('city')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="sales_person" class="font-bold">Sales Person</label>
                        <x-text-input name="sales_person" label="Sales Person" placeholder="e.g. Yomesh "
                            value="{{old('sales_person')}}" />
                        @error('sales_person')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <hr class="mt-2">

                    <div class="grid grid-cols-2 gap-2">

                        <div class="flex flex-col mt-2">
                            <label for="num_desktops" class="font-bold">Number of Desktops</label>
                            <x-text-input type="number" name="num_desktops" label="Number of Desktops" min="0"
                                placeholder="e.g. 52" value="{{old('num_desktops')}}" />
                            @error('num_desktops')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_notebooks" class="font-bold">Number of Notebooks</label>
                            <x-text-input type="number" name="num_notebooks" label="Number of Notebooks" min="0"
                                placeholder="e.g. 65" value="{{old('num_notebooks')}}" />
                            @error('num_notebooks')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_printers" class="font-bold">Number of Printers</label>
                            <x-text-input type="number" name="num_printers" label="Number of Printers" min="0"
                                placeholder="e.g. 32" value="{{old('num_printers')}}" />
                            @error('num_printers')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_servers" class="font-bold">Number of Servers</label>
                            <x-text-input type="number" name="num_servers" label="Number of Servers" min="0"
                                placeholder="e.g. 11" value="{{old('num_servers')}}" />
                            @error('num_servers')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_firewalls" class="font-bold">Number of Firewalls</label>
                            <x-text-input type="number" name="num_firewalls" label="Number of Firewalls" min="0"
                                placeholder="e.g. 25" value="{{old('num_firewalls')}}" />
                            @error('num_firewalls')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_wifi_access_points" class="font-bold">Number of Wifi Access Points</label>
                            <x-text-input name="num_wifi_access_points" label="Number of Wifi Access Points" min="0"
                                type="number" placeholder="e.g. 11" value="{{old('num_wifi_access_points')}}" />
                            @error('num_wifi_access_points')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_switches" class="font-bold">Number of Switches</label>
                            <x-text-input type="number" name="num_switches" label="Number of Switches" min="0"
                                placeholder="e.g. 15" value="{{old('num_switches')}}" />
                            @error('num_switches')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>


                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="quote_provided" class="font-bold">Quote Provided</label>
                        <x-text-input name="quote_provided" label="Quote Provided" min="0" placeholder="e.g. 1000/mo"
                            value="{{old('quote_provided')}}" />
                        @error('quote_provided')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <button type="submit"
                        class="col-span-2 span-2 mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Add Customer +</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>