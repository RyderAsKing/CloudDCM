<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Managing Users') }}
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

            <a href="{{route('users.create')}}" type="button"
                class="mb-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                Create user +
            </a>
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
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{$user->name}}
                                            @foreach($user->roles as $role)
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{$role->name}}</span>
                                            @endforeach
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