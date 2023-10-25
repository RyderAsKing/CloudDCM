<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Managing rack {{$rack->name}}
        </h2>
    </x-slot>

    {{-- loop through rackSpaces and display all rackSpaces in a nice formatted table with options to edit and delete.
    the rows are name, description, client_email.
    style using Tailwind css
    --}}
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

            <div class="flex flex-col">

                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-white">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">ID</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Name
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Description</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Client Email</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @foreach ($rack->rackSpaces as $rackSpace)
                                    <tr class="text-neutral-800 bg-white">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                            {{$rackSpace->unit_number}}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">@if($rackSpace->name != null) {{
                                            $rackSpace->name }} @else
                                            Not assigned @endif</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            @if($rackSpace->description != null) {{
                                            $rackSpace->description }} @else
                                            Not assigned @endif
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            @if($rackSpace->client_email != null) {{
                                            $rackSpace->client_email }} @else
                                            Not assigned @endif </td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('racks.show', $rack->id)}}">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>