<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('My Exams') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse($exams as $exam)
                @php
                    $attempt = $exam->attempts->first();
                @endphp

                <div class="bg-white dark:bg-gray-800 mb-4 p-6 rounded shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">
                                {{ $exam->title }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                Time Limit: {{ $exam->duration }} min
                            </p>
                        </div>

                        <div class="text-right">
                            @if(!$attempt)
                                <span class="text-yellow-600 font-semibold">
                                    Not Started
                                </span>
                            @elseif($attempt->is_submitted)
                                <span class="text-green-600 font-semibold">
                                    Submitted
                                </span>
                            @else
                                <span class="text-blue-600 font-semibold">
                                    In Progress
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        @if(!$attempt || !$attempt->is_submitted)
                            {{-- <a
                                href="{{ route('student.exams.show', $exam) }}"
                                class="inline-block bg-blue-600 text-white px-4 py-2 rounded"
                            >
                                {{ $attempt ? 'Continue Exam' : 'Start Exam' }}
                            </a> --}}
                            <button
                                onclick="openStartModal({{ $exam->id }})"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                                {{ $attempt ? 'Continue Exam' : 'Start Exam' }}
                            </button>
                        {{-- @else
                            <a
                                href="{{ route('student.exams.result', $exam) }}"
                                class="inline-block bg-gray-600 text-white px-4 py-2 rounded"
                            >
                                View Result
                            </a>
                        @endif --}}
                        @elseif($attempt->is_submitted && $attempt->is_graded)
                            <a
                                href="{{ route('student.exams.result', $exam) }}"
                                class="inline-block bg-green-600 text-white px-4 py-2 rounded"
                            >
                                View Result
                            </a>

                        @elseif($attempt->is_submitted && !$attempt->is_graded)
                            <span class="inline-block bg-yellow-100 text-yellow-700 px-4 py-2 rounded">
                                Waiting for lecturer grading
                            </span>
                        @endif

                    </div>
                </div>

            @empty
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <p class="text-gray-500">
                        Tiada exam untuk kelas anda.
                    </p>
                </div>
            @endforelse

        </div>
    </div>

    <!-- Modal -->
    <div id="startModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
        <div class="bg-white p-6 rounded w-96">
            <h2 class="text-lg font-semibold mb-2">Confirm Start Exam</h2>
            <p class="text-sm mb-4">
                Masa exam akan bermula dan tidak boleh dihentikan.
            </p>

            <form id="startForm" method="POST">
                @csrf
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeStartModal()">Cancel</button>
                    <button class="bg-red-600 text-white px-4 py-2 rounded">
                        Start
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openStartModal(examId) {
        document.getElementById('startForm').action =
            `/student/exams/${examId}/start`;
        document.getElementById('startModal').classList.remove('hidden');
    }

    function closeStartModal() {
        document.getElementById('startModal').classList.add('hidden');
    }
    </script>
</x-app-layout>
