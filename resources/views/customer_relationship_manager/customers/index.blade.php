<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Customers') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
            @endif

            <div class="flex justify-between">
                <a href="{{route('customer_relationship_manager.customers.create')}}" type="button"
                    class="mb-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tcustomering-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                    Add customer +
                </a>

                <form action="{{route('customer_relationship_manager.customers.index')}}" class="flex gap-2 my-2">
                    <x-text-input name="search" placeholder="eg. Something LLC">
                    </x-text-input>
                    <x-primary-button type="submit">Search</x-primary-button>
                </form>
            </div>
            <div class="flex flex-col">
                <div class="backdrop-blur-sm bg-white p-6 rounded-md shadow-sm  border-2 border-gray-50 ">
                    <h2 class="text-xl font-semibold mb-4">Welcome to Customer Relationship Manager</h2>
                    <p class="text-gray-700">Here you can manage your customers </p>
                    @if(count($customers) < 1) <p class="text-gray-700">You have no customers yet, click the button
                        above to get started</p>
                        @endif
                </div>
                <div class="overflow-x-auto mt-2">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-white">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Company Name</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Status
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Phone
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Email</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @if ($customers->isEmpty())

                                    <tr class="bg-white text-neutral-500">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">No customer found.
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        </td>
                                    </tr>
                                    @endif

                                    @foreach ($customers as $customer)
                                    <tr class="text-neutral-800 bg-white">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap flex items-center">
                                            {{$customer->company_name}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            @switch($customer->status)
                                            @case('potential')
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Potential</span>
                                            @break
                                            @case('active')
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Active</span>
                                            @break
                                            @case('cancelled')
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Cancelled</span>
                                            @break
                                            @case('not_interested')
                                            <span
                                                class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Not
                                                Interested</span>
                                            @break
                                            @default
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Unkown</span>
                                            @endswitch
                                        </td>

                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{$customer->phone}}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{$customer->email}}
                                        </td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('customer_relationship_manager.customers.show', $customer->id)}}">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>