<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Subjek</h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto">
        <form method="POST"
              action="{{ route('lecturer.subjects.update', $subject) }}"
              class="bg-white p-6 shadow rounded">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama Subjek</label>
                <input name="name"
                       value="{{ $subject->name }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Kelas</label>
                <select name="class_room_id" class="w-full border rounded p-2">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}"
                            @selected($subject->class_room_id == $class->id)>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Kemaskini
            </button>
        </form>
    </div>
</x-app-layout>
