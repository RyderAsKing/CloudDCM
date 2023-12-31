<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing Customer: ' . $customer->company_name) }}
        </h2>
    </x-slot>

    <div>
        <div class=" mx-auto ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Edit a Customer') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Edit a customer that you have already added to the CRM") }}
                    </p>
                </header>
                <form action="{{ route('customer_relationship_manager.customers.update', $customer->id) }}"
                    method="POST" class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="grid grid-cols-2 gap-2">
                        <div>

                            <div class="flex flex-col mt-2">
                                <label for="company_name" class="font-bold">Company Name*</label>
                                <x-text-input name="company_name" label="Company Name" placeholder="e.g. Example LLC"
                                    value="{{$customer->company_name}}" />
                                @error('company_name')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="flex flex-col mt-2">
                                <label for="phone" class="font-bold">Phone</label>
                                <x-text-input name="phone" label="Phone" placeholder="e.g. +1 824739921"
                                    value="{{$customer->phone}}" />
                                @error('phone')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                            <div class="flex flex-col mt-2">
                                <label for="website" class="font-bold">Website</label>
                                <x-text-input name="url" label="URL" placeholder="e.g. example.com"
                                    value="{{$customer->url}}" />
                                @error('url')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="font-bold">Notes</label>
                            <textarea type="text" placeholder="Type your note here." name="notes"
                                class="flex w-full h-32 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{$customer->notes}}</textarea>
                            @error('notes')
                            <x-input-error :messages="$message" />
                            @enderror

                            <label for="status" class="mt-2 font-bold">Status</label>
                            <select name="status" id="status"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="potential" @if($customer->status == 'potential') selected
                                    @endif>potential</option>
                                <option value="active" @if($customer->status == 'active') selected
                                    @endif>active</option>
                                <option value="cancelled" @if($customer->status == 'cancelled') selected
                                    @endif>cancelled</option>
                                <option value="not_interested" @if($customer->status == 'not_interested') selected
                                    @endif>not interested</option>

                                <option value="contacted" @if($customer->status == 'contacted') selected
                                    @endif>contacted</option>
                            </select>
                            @error('status')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>
                    </div>


                    <div class="flex flex-col mt-2">
                        <label for="email" class="font-bold">Email</label>
                        <x-text-input name="email" label="Email" placeholder="e.g. someone@example.com"
                            value="{{$customer->email}}" />
                        @error('email')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="contact_name" class="font-bold">Contact Name</label>
                        <x-text-input name="contact_name" label="Contact Name" placeholder="e.g. JOHN DOE"
                            value="{{$customer->contact_name}}" />
                        @error('contact_name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="address" class="font-bold">Address</label>
                        <x-text-input name="address" label="Address" placeholder="e.g. 6-3-299/1, Padmarao Nagar"
                            value="{{$customer->address}}" />
                        @error('address')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="city" class="font-bold">City</label>
                        <x-text-input name="city" label="City" placeholder="e.g. Dallas" value="{{$customer->city}}" />
                        @error('city')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="sales_person" class="font-bold">Sales Person</label>
                        <x-text-input name="sales_person" label="Sales Person" placeholder="e.g. Yomesh "
                            value="{{$customer->sales_person}}" />
                        @error('sales_person')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <hr class="mt-2">

                    <div class="grid grid-cols-2 gap-2">

                        <div class="flex flex-col mt-2">
                            <label for="num_desktops" class="font-bold">Number of Desktops</label>
                            <x-text-input type="number" name="num_desktops" label="Number of Desktops" min="0"
                                placeholder="e.g. 52" value="{{$customer->num_desktops}}" />
                            @error('num_desktops')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_notebooks" class="font-bold">Number of Notebooks</label>
                            <x-text-input type="number" name="num_notebooks" label="Number of Notebooks" min="0"
                                placeholder="e.g. 65" value="{{$customer->num_notebooks}}" />
                            @error('num_notebooks')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_printers" class="font-bold">Number of Printers</label>
                            <x-text-input type="number" name="num_printers" label="Number of Printers" min="0"
                                placeholder="e.g. 32" value="{{$customer->num_printers}}" />
                            @error('num_printers')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_servers" class="font-bold">Number of Servers</label>
                            <x-text-input type="number" name="num_servers" label="Number of Servers" min="0"
                                placeholder="e.g. 11" value="{{$customer->num_servers}}" />
                            @error('num_servers')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_firewalls" class="font-bold">Number of Firewalls</label>
                            <x-text-input type="number" name="num_firewalls" label="Number of Firewalls" min="0"
                                placeholder="e.g. 25" value="{{$customer->num_firewalls}}" />
                            @error('num_firewalls')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_wifi_access_points" class="font-bold">Number of Wifi Access Points</label>
                            <x-text-input name="num_wifi_access_points" label="Number of Wifi Access Points" min="0"
                                type="number" placeholder="e.g. 11" value="{{$customer->num_wifi_access_points}}" />
                            @error('num_wifi_access_points')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="num_switches" class="font-bold">Number of Switches</label>
                            <x-text-input type="number" name="num_switches" label="Number of Switches" min="0"
                                placeholder="e.g. 15" value="{{$customer->num_switches}}" />
                            @error('num_switches')
                            <x-input-error :messages="$message" />
                            @enderror
                        </div>


                    </div>

                    <div class="flex flex-col mt-2">
                        <label for="quote_provided" class="font-bold">Quote Provided</label>
                        <x-text-input name="quote_provided" label="Quote Provided" min="0" placeholder="e.g. 1000/mo"
                            value="{{$customer->quote_provided}}" />
                        @error('quote_provided')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>

                    <x-primary-button class="mt-2" style="width: fit-content;">Edit Customer</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>