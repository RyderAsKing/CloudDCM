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
                <form action="{{ route('colocation_manager.racks.store') }}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Company Name</label>
                        <x-text-input name="name" label="Rack Name" placeholder="e.g. Rack 1" value="{{old('name')}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="phone" class="font-bold">Phone</label>
                        <x-text-input name="phone" label="Phone" placeholder="e.g. Very cool rack"
                            value="{{old('phone')}}" />
                        @error('phone')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>


                    <div class="flex flex-col mt-2">
                        <label for="email" class="font-bold">Email</label>
                        <x-text-input name="email" label="Email" placeholder="e.g. Very cool rack"
                            value="{{old('email')}}" />
                        @error('email')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="contact_name" class="font-bold">Contact Name</label>
                        <x-text-input name="contact_name" label="Contact Name" placeholder="e.g. Very cool rack"
                            value="{{old('contact_name')}}" />
                        @error('contact_name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="address" class="font-bold">Address</label>
                        <x-text-input name="address" label="Address" placeholder="e.g. Very cool rack"
                            value="{{old('address')}}" />
                        @error('address')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="city" class="font-bold">City</label>
                        <x-text-input name="city" label="City" placeholder="e.g. Very cool rack"
                            value="{{old('city')}}" />
                        @error('city')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="sales_person" class="font-bold">Sales Person</label>
                        <x-text-input name="sales_person" label="Sales Person" placeholder="e.g. Very cool rack"
                            value="{{old('sales_person')}}" />
                        @error('sales_person')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_desktops" class="font-bold">Number of Desktops</label>
                        <x-text-input name="num_desktops" label="Number of Desktops" placeholder="e.g. Very cool rack"
                            value="{{old('num_desktops')}}" />
                        @error('num_desktops')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_notebooks" class="font-bold">Number of Notebooks</label>
                        <x-text-input name="num_notebooks" label="Number of Notebooks" placeholder="e.g. Very cool rack"
                            value="{{old('num_notebooks')}}" />
                        @error('num_notebooks')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_printers" class="font-bold">Number of Printers</label>
                        <x-text-input name="num_printers" label="Number of Printers" placeholder="e.g. Very cool rack"
                            value="{{old('num_printers')}}" />
                        @error('num_printers')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_servers" class="font-bold">Number of Servers</label>
                        <x-text-input name="num_servers" label="Number of Servers" placeholder="e.g. Very cool rack"
                            value="{{old('num_servers')}}" />
                        @error('num_servers')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_firewalls" class="font-bold">Number of Firewalls</label>
                        <x-text-input name="num_firewalls" label="Number of Firewalls" placeholder="e.g. Very cool rack"
                            value="{{old('num_firewalls')}}" />
                        @error('num_firewalls')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_wifi_access_points" class="font-bold">Number of Wifi Access Points</label>
                        <x-text-input name="num_wifi_access_points" label="Number of Wifi Access Points"
                            placeholder="e.g. Very cool rack" value="{{old('num_wifi_access_points')}}" />
                        @error('num_wifi_access_points')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="num_switches" class="font-bold">Number of Switches</label>
                        <x-text-input name="num_switches" label="Number of Switches" placeholder="e.g. Very cool rack"
                            value="{{old('num_switches')}}" />
                        @error('num_switches')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>


                    <div class="flex flex-col mt-2">
                        <label for="quote_provided" class="font-bold">Quote Provided</label>
                        <x-text-input name="quote_provided" label="Quote Provided" placeholder="e.g. Very cool rack"
                            value="{{old('quote_provided')}}" />
                        @error('quote_provided')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>


                    <div class="flex flex-col mt-2">
                        <label for="quote_provided" class="font-bold">Quote Provided</label>
                        <x-text-input name="quote_provided" label="Quote Provided" placeholder="e.g. Very cool rack"
                            value="{{old('quote_provided')}}" />
                        @error('quote_provided')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="quote_provided" class="font-bold">Quote Provided</label>
                        <x-text-input name="quote_provided" label="Quote Provided" placeholder="e.g. Very cool rack"
                            value="{{old('quote_provided')}}" />
                        @error('quote_provided')
                        <x-input-error :messages="$message" />
                        @enderror

                    </div>

                    <button type="submit"
                        class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        style="width: fit-content;">Add Customer +</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>