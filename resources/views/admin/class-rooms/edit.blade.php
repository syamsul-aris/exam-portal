<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">
        {{ isset($classRoom) ? 'Edit Class' : 'Add Class' }}
    </h2>
</x-slot>

<div class="py-12 max-w-xl mx-auto">
<form method="POST"
      action="{{ isset($classRoom)
        ? route('admin.class-rooms.update', $classRoom)
        : route('admin.class-rooms.store') }}">

@csrf
@isset($classRoom)
@method('PUT')
@endisset

<div class="mb-4">
<label>Class Name</label>
<input name="name" class="w-full border p-2"
       value="{{ old('name', $classRoom->name ?? '') }}">
</div>

<div class="mb-4">
<label>Code</label>
<input name="code" class="w-full border p-2"
       value="{{ old('code', $classRoom->code ?? '') }}">
</div>

<div class="mb-4">
<label>Description</label>
<textarea name="description" class="w-full border p-2">
{{ old('description', $classRoom->description ?? '') }}
</textarea>
</div>

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Save
</button>

</form>
</div>
</x-app-layout>
