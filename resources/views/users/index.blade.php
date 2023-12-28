<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Users') }}
        </h2>
    </x-slot>



    <div>
        <div class="mx-auto">

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

            <x-primary-link href="{{route('users.create')}}" class="mb-2">
                Create user +
            </x-primary-link>
            <div class="flex flex-col">

                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden border rounded-lg">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead class="bg-white">
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">#</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Name</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Email
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Email Verified
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Subuser
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @if ($users->isEmpty())

                                    <tr class="bg-white text-neutral-500">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap" colspan="6">No users
                                            found.
                                        </td>
                                    </tr>
                                    @endif

                                    @foreach ($users as $user)
                                    <tr class="text-neutral-800 bg-white">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{$user->id}}
                                        </td>

                                        <td
                                            class="px-5 py-4 text-sm font-medium whitespace-nowrap flex justify-between">
                                            {{$user->name}}
                                            <div x-data="{
                                                    tooltipVisible: false,
                                                    tooltipText: '@foreach($user->roles as $role) | {{$role->name}}  @endforeach',
                                                    tooltipArrow: true,
                                                    tooltipPosition: 'top',
                                                }"
                                                x-init="$refs.content.addEventListener('mouseenter', () => { tooltipVisible = true; }); $refs.content.addEventListener('mouseleave', () => { tooltipVisible = false; });"
                                                class="relative">
                                                <div x-ref="tooltip" x-show="tooltipVisible"
                                                    :class="{ 'top-0 left-1/2 -translate-x-1/2 -mt-0.5 -translate-y-full' : tooltipPosition == 'top', 'top-1/2 -translate-y-1/2 -ml-0.5 left-0 -translate-x-full' : tooltipPosition == 'left', 'bottom-0 left-1/2 -translate-x-1/2 -mb-0.5 translate-y-full' : tooltipPosition == 'bottom', 'top-1/2 -translate-y-1/2 -mr-0.5 right-0 translate-x-full' : tooltipPosition == 'right' }"
                                                    class="absolute w-auto text-sm" x-cloak>
                                                    <div x-show="tooltipVisible" x-transition
                                                        class="relative px-2 py-1 text-white bg-black rounded bg-opacity-90">
                                                        <p x-text="tooltipText"
                                                            class="flex-shrink-0 block text-xs whitespace-nowrap"></p>
                                                        <div x-ref="tooltipArrow" x-show="tooltipArrow"
                                                            :class="{ 'bottom-0 -translate-x-1/2 left-1/2 w-2.5 translate-y-full' : tooltipPosition == 'top', 'right-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px translate-x-full' : tooltipPosition == 'left', 'top-0 -translate-x-1/2 left-1/2 w-2.5 -translate-y-full' : tooltipPosition == 'bottom', 'left-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px -translate-x-full' : tooltipPosition == 'right' }"
                                                            class="absolute inline-flex items-center justify-center overflow-hidden">
                                                            <div :class="{ 'origin-top-left -rotate-45' : tooltipPosition == 'top', 'origin-top-left rotate-45' : tooltipPosition == 'left', 'origin-bottom-left rotate-45' : tooltipPosition == 'bottom', 'origin-top-right -rotate-45' : tooltipPosition == 'right' }"
                                                                class="w-1.5 h-1.5 transform bg-black bg-opacity-90">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div x-ref="content"
                                                    class="px-3 py-1 text-xs rounded-full cursor-pointer text-neutral-500 bg-neutral-100">
                                                    modules
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{$user->email}}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            @if ($user->email_verified_at != null)

                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Yes</span>
                                            @else
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">No</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            @if ($user->owner_id != null)
                                            <a href="{{ route('users.edit', $user->owner_id)}}">
                                                <span
                                                    class="bg-green-100 text-green-800 hover:text-blue-500 text-xs font-semibold px-2.5 py-0.5 rounded-full">Yes</span>
                                            </a>
                                            @else
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">No</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap flex justify-end gap-2">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('users.edit', $user->id)}}">Edit</a>
                                            @hasrole('admin')
                                            @if ($user->id != Auth::user()->id)
                                            <a class="text-blue-600 hover:text-blue-700"
                                                href="{{route('users.show', $user->id)}}">Impersonate</a>
                                            @endhasrole
                                            @endif
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
                {{ $users->links() }}
            </div>
        </div>
    </div>

</x-app-layout>