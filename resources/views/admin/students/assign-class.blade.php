<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">Assign Class to Student</h2>
</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div class="mb-4 text-green-600">{{ session('success') }}</div>
@endif

<table class="w-full bg-white shadow rounded">
<thead>
<tr class="border-b">
    <th class="p-3">Student</th>
    <th class="p-3">Email</th>
    <th class="p-3">Class</th>
    <th class="p-3">Action</th>
</tr>
</thead>

<tbody>
@foreach($students as $student)
<tr class="border-b">
<td class="p-3">{{ $student->name }}</td>
<td class="p-3">{{ $student->email }}</td>
<td class="p-3">{{ $student->classRoom->name ?? 'N/A' }}</td>

<td class="p-3">
<form method="POST"
      action="{{ route('admin.students.assign-class.update', $student) }}"
      class="flex gap-2">
@csrf
@method('PUT')

<select name="class_room_id" class="border p-1">
@foreach($classes as $class)
<option value="{{ $class->id }}"
    @selected($student->class_room_id == $class->id)>
    {{ $class->name }}
</option>
@endforeach
</select>

<button class="bg-blue-600 text-white px-3 py-1 rounded">
Save
</button>

</form>
</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>
</x-app-layout>
