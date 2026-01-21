<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Subjek</h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto">
        <form method="POST"
              action="{{ route('lecturer.subjects.store') }}"
              class="bg-white p-6 shadow rounded">
            @csrf

            <div class="mb-4">
                <label>Nama Subjek</label>
                <input name="name" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Kelas</label>
                <select name="class_room_id" class="w-full border rounded p-2">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
