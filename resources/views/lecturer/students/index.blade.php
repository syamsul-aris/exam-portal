<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">My Students</h2>
</x-slot>

<div class="py-12 max-w-5xl mx-auto">
<table class="w-full bg-white shadow rounded">
<thead>
<tr class="border-b">
    <th class="p-3">Name</th>
    <th class="p-3">Email</th>
</tr>
</thead>

<tbody>
@foreach($students as $student)
<tr class="border-b">
    <td class="p-3">{{ $student->name }}</td>
    <td class="p-3">{{ $student->email }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</x-app-layout>
