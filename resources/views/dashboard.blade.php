<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- ADMIN --}}
            @role('Admin')
                @include('dashboard.cards', ['title' => 'Users', 'value' => $totalUsers])
                @include('dashboard.cards', ['title' => 'Classes', 'value' => $totalClasses])
                @include('dashboard.cards', ['title' => 'Subjects', 'value' => $totalSubjects])
                @include('dashboard.cards', ['title' => 'Exams', 'value' => $totalExams])
            @endrole

            {{-- LECTURER --}}
            @role('Lecturer')
                 @include('dashboard.cards', ['title' => 'My Class', 'value' => optional($class)->name ?? '-'])
                {{-- @include('dashboard.cards', ['title' => 'Subjects', 'value' => $subjects->count()]) --}}
                @include('dashboard.cards', ['title' => 'My Exams', 'value' => $totalExams])
                @include('dashboard.cards', ['title' => 'Submissions', 'value' => $totalSubmissions])
            @endrole

            {{-- STUDENT --}}
            @role('Student')
                @include('dashboard.cards', ['title' => 'My Class', 'value' => optional($class)->name ?? '-'])
                {{-- @include('dashboard.cards', ['title' => 'Subjects', 'value' => $subjects->count()]) --}}
                @include('dashboard.cards', ['title' => 'Available Exams', 'value' => $availableExams])
                @include('dashboard.cards', ['title' => 'Completed Exams', 'value' => $completedExams])
            @endrole

        </div>
    </div>
</x-app-layout>
