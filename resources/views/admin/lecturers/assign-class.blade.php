<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">Assign Lecturer to Class</h2>
</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div class="mb-4 text-green-600">{{ session('success') }}</div>
@endif

<table class="w-full bg-white shadow rounded">
<thead>
<tr class="border-b">
    <th class="p-3">Lecturer</th>
    <th class="p-3">Email</th>
    <th class="p-3">Class</th>
</tr>
</thead>

<tbody>
@foreach($lecturers as $lecturer)
<tr class="border-b">
<td class="p-3">{{ $lecturer->name }}</td>
<td class="p-3">{{ $lecturer->email }}</td>
<td class="p-3">{{ $lecturer->classRoom->name ?? 'N/A' }}</td>

<td class="p-3">
<form method="POST"
    action="{{ route('admin.lecturers.assign-class.update', $lecturer) }}"
    class="flex gap-2">
@csrf
@method('PUT')

<select name="class_room_id" class="border p-1">
@foreach($classes as $class)
<option value="{{ $class->id }}"
    @selected($lecturer->class_room_id == $class->id)>
    {{ $class->name }}
</option>
@endforeach
</select>

<button class="bg-blue-600 text-white px-3 py-1 rounded">
Save
</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</x-app-layout>
