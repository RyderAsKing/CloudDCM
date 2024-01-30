<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Viewing a subnet') }}
            </h2>

            <form method="post" action="{{route('ip_manager.subnets.destroy', $subnet)}}">
                @csrf
                @method('DELETE')
                <x-primary-button type="submit" class="bg-red-500 hover:bg-red-600">
                    Delete X
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div>

        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-xl p-8 rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 flex gap-2">
                        {{ __('Editing subnet ' . $subnet->name) }}
                        <span
                            class="bg-blue-600 text-white relative flex items-center text-xs font-semibold px-2 py-1 rounded-full ">
                            @if($subnet->parent_id == null) Parent subnet @else Child subnet @endif
                        </span>
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("View/Update information about the subnet.") }}
                    </p>
                </header>
                <form action="{{route('ip_manager.subnets.update', $subnet)}}" method="POST"
                    class="mt-4 flex flex-col gap-2">
                    @method('PATCH')
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="font-bold">Name*</label>

                        <x-text-input name="name" label="Name" placeholder="e.g. dal.xyz.com"
                            value="{{$subnet->name ?? ''}}" />
                        @error('name')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    {{-- <div class="flex flex-col mt-2">
                        <label for="description" class="font-bold"> Description</label>

                        <x-text-input name="description" label="Description"
                            placeholder="e.g. This server is used for ..." value="{{$subnet->description ?? ''}}" />
                        @error('description')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div> --}}
                    <div class="flex flex-col mt-2">
                        <label for="subnet" class="font-bold">Subnet</label>
                        <x-text-input name="subnet" label="Phone" placeholder="e.g. 127.0.0.0/24"
                            value="{{$subnet->subnet}}" />
                        @error('subnet')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="vlan" class="font-bold">VLAN</label>
                        <x-text-input name="vlan" label="URL" placeholder="e.g. VLAN 30" value="{{$subnet->vlan}}" />
                        @error('vlan')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="leased_company" class="font-bold">Leased Company</label>
                        <x-text-input name="leased_company" label="URL" placeholder="e.g. IPXO"
                            value="{{$subnet->leased_company}}" />
                        @error('leased_company')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="parent_id" class="font-bold">Parent Subnet</label>
                        <select id="parent_id" name="parent_id" style="width: 100%;">
                            <option value=" ">None</option>
                            @foreach ($subnets as $parent_subnet)
                            <option value="{{$parent_subnet->id}}" @if($subnet->parent_id == $parent_subnet->id)
                                selected @endif>{{$parent_subnet->name}} |
                                {{$parent_subnet->subnet}}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <x-input-error :messages="$message" />
                        @enderror
                    </div>
                    <x-primary-button type="submit" style="width: fit-content;">Update &rarr;</x-primary-button>
                </form>
            </div>

            @if($subnet->parent_id == null)
            <div class="overflow-x-auto mt-4">
                <h1 class="text-lg">Children Subnets</h1>
                <div class="inline-block min-w-full">
                    <div class="overflow-hidden border rounded-lg">
                        <table class="min-w-full divide-y divide-neutral-200">
                            <thead class="bg-white">
                                <tr class="text-neutral-500">
                                    <th class="px-5 py-3 text-xs font-medium text-left uppercase">Subnet Name</th>
                                    <th class="px-5 py-3 text-xs font-medium text-left uppercase">Subnet</th>
                                    <th class="px-5 py-3 text-xs font-medium text-left uppercase">VLAN
                                    <th class="px-5 py-3 text-xs font-medium text-left uppercase">Leased Company
                                    </th>
                                    <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200">
                                @if ($children->isEmpty())

                                <tr class="bg-white text-neutral-500">
                                    <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">No subnet found.
                                    </td>
                                    <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                    <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                    <td class="px-5 py-4 text-sm whitespace-nowrap"></td>
                                    <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    </td>
                                </tr>
                                @endif

                                @foreach ($children as $child)
                                <tr class="text-neutral-800 bg-white">
                                    <td class="px-5 py-4 text-sm font-medium whitespace-nowrap flex items-center">
                                        {{$child->name}}
                                    </td>
                                    <td class="px-5 py-4 text-sm whitespace-nowrap">
                                        {{$child->subnet}}
                                    </td>
                                    <td class="px-5 py-4 text-sm whitespace-nowrap">
                                        {{$child->vlan}}
                                    </td>
                                    <td class="px-5 py-4 text-sm whitespace-nowrap">
                                        {{$child->leased_company}}
                                    </td>
                                    <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        <a class="text-blue-600 hover:text-blue-700"
                                            href="{{route('ip_manager.subnets.show', $child->id)}}">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>