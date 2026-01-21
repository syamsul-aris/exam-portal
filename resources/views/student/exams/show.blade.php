<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold">Exam: {{ $exam->title }}</h1>
       <h5 class="text-s font-semibold">
    Masa Mula: {{ $attempt->started_at->format('d M Y, H:i') }}
</h5>
<h5 class="text-s font-semibold">
    Masa Tamat: {{ $attempt->ended_at->format('d M Y, H:i') }}
</h5>

        <div class="bg-red-100 text-red-700 p-3 rounded mt-4">⏳ Time left: <span id="timer"></span>
</div>

    </x-slot>
    <form id="examForm" method="POST" action="{{ route('student.exams.submit', $exam) }}">

    {{-- <form method="POST" action="{{ route('student.exams.submit', $exam) }}"> --}}
        @csrf

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach($exam->questions as $question)
                <div class="bg-white p-4 rounded shadow">
                    <p class="font-semibold">
                        {{ $loop->iteration }}. {{ $question->question }}
                        <span class="text-sm text-gray-500">({{ $question->marks }} markah)</span>
                    </p>

                    @php
                        $options = is_array($question->options)
                            ? $question->options
                            : json_decode($question->options, true);
                    @endphp

                    @if($question->type === 'mcq')
                        @foreach($options ?? [] as $option)
                            @if($option)
                                <label class="block">
                                    <input
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option }}"
                                        required
                                    >
                                    {{ $option }}
                                </label>
                            @endif
                        @endforeach
                    @endif

                    @if($question->type === 'text')
                        <textarea
                            name="answers[{{ $question->id }}]"
                            rows="4"
                            class="w-full mt-2 border rounded p-2"
                            required
                        ></textarea>
                    @endif
                </div>
            @endforeach

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 mt-5 rounded"
            >
                Submit Exam
            </button>
        </div>
        </div>
    </form>
</x-app-layout>

<script>
const endTime = new Date(
    "{{ $attempt->ended_at->toIso8601String() }}"
).getTime();

const timer = setInterval(() => {
    const now = new Date().getTime();
    const distance = endTime - now;

    if (distance <= 0) {
        clearInterval(timer);
        document.getElementById('timer').innerText = "Time's up!";
        document.getElementById('examForm').submit();
        return;
    }

    const minutes = Math.floor(distance / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('timer').innerText =
        `${minutes}m ${seconds}s`;
}, 1000);
</script>


