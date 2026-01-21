<x-app-layout>
<x-slot name="header">Assign Exam to Class</x-slot>

<form method="POST">
@csrf
@foreach($classes as $class)
<label class="block">
<input type="checkbox" name="class_ids[]" value="{{ $class->id }}"
    @checked($exam->classes->contains($class))>
{{ $class->name }}
</label>
@endforeach
<button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Save</button>
</form>
</x-app-layout>
