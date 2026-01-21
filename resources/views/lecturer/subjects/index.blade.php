<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Konfigurasi Subjek
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('lecturer.subjects.create') }}"
               class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Subjek
            </a>

            <div class="bg-white dark:bg-gray-800 shadow rounded">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Kelas</th>
                            <th class="p-3">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr class="border-b">
                            <td class="p-3">{{ $subject->name }}</td>
                            <td class="p-3">{{ $subject->classRoom->name }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('lecturer.subjects.edit', $subject) }}"
                                   class="text-blue-500">Edit</a>

                                <form method="POST"
                                      action="{{ route('lecturer.subjects.destroy', $subject) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"
                                            onclick="return confirm('Padam subjek?')">
                                        Delete
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
