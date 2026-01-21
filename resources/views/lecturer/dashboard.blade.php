<x-app-layout>
<x-slot name="header">Lecturer Dashboard</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="grid grid-cols-3 gap-4">
<div class="bg-white p-4">Exams: {{ $exams }}</div>
<div class="bg-white p-4">Students: {{ $students }}</div>
<div class="bg-white p-4">Attempts: {{ $attempts }}</div>
</div>
</div>
</div>
</x-app-layout>
