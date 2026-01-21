<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Manage Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow rounded">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-3">Name</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-b">
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">
                                {{ $user->roles->pluck('name')->join(', ') ?: '—' }}
                            </td>
                            <td class="p-3">
                                <form method="POST"
                                      action="{{ route('admin.users.update-role', $user) }}"
                                      class="flex gap-2">
                                    @csrf
                                    @method('PUT')

                                    <select name="role"
                                            class="border rounded px-2 py-1">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}"
                                                @selected($user->hasRole($role->name))>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button class="bg-blue-600 text-white px-3 py-1 rounded">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</x-app-layout>
