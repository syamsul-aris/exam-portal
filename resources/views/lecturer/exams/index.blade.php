<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Exams Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Action --}}
            <div class="mb-4">
                <a href="{{ route('lecturer.exams.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    + Create Exam
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-3">Title</th>
                            <th class="p-3">Subject</th>
                            <th class="p-3">Duration</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($exams as $exam)
                            <tr class="border-t dark:border-gray-700">
                                <td class="p-3 font-medium">
                                    {{ $exam->title }}
                                </td>

                                <td class="p-3">
                                    {{ $exam->subject->name }}
                                </td>

                                <td class="p-3">
                                    {{ $exam->duration }} min
                                </td>

                                <td class="p-3">
                                    @if($exam->is_active)
                                        <span class="text-green-600 font-semibold">
                                            Active
                                        </span>
                                    @else
                                        <span class="text-gray-500">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td class="p-3 space-x-2">
                                    {{-- Manage Question --}}
                                    <button class="px-2 py-1 rounded text-white bg-blue-600">
                                        <a href="{{ route('lecturer.questions.index', $exam) }}"
                                           >
                                            Questions
                                        </a>
                                    </button>

                                    {{-- Result --}}
                                    {{-- <a href="{{ route('lecturer.exams.results', $exam) }}"
                                       class="text-green-600 hover:underline">
                                        Results
                                    </a> --}}

                                     <form method="POST"
                                    action="{{ route('lecturer.exams.toggle', $exam) }}"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')

                                    <button class="px-2 py-1 rounded text-white
                                        {{ $exam->is_active ? 'bg-red-600' : 'bg-green-600' }}">
                                        {{ $exam->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>

                                    <button class="px-2 py-1 rounded text-white bg-green-600">
                                        <a 
                                           href="{{ route('lecturer.exams.results', $exam) }}">
                                            Grade
                                        </a>
                                    </button>
                                </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">
                                    No exam created yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
