<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">Manage Class</h2>
</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div class="mb-4 text-green-600">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.class-rooms.create') }}"
   class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
    + Add Class
</a>

<div class="bg-white shadow rounded">
<table class="w-full">
<thead>
<tr class="border-b">
    <th class="p-3">Name</th>
    <th class="p-3">Code</th>
    <th class="p-3">Description</th>
    <th class="p-3">Action</th>
</tr>
</thead>

<tbody>
@foreach($classes as $class)
<tr class="border-b">
    <td class="p-3">{{ $class->name }}</td>
    <td class="p-3">{{ $class->code }}</td>
    <td class="p-3">{{ $class->description }}</td>
    <td class="p-3 flex gap-2">
        <a href="{{ route('admin.class-rooms.edit', $class) }}"
            class="text-blue-500">Edit</a>

        <form method="POST"
              action="{{ route('admin.class-rooms.destroy', $class) }}"
              onsubmit="return confirm('Padam class ini?')">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Delete</button>
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
