<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">
        {{ $exam->title }} – {{ $attempt->student->name }}
    </h2>
</x-slot>

<form method="POST"
    action="{{ route('lecturer.exams.results.grade', [$exam, $attempt]) }}">
@csrf

<div class="py-8 max-w-7xl mx-auto space-y-4">

@foreach($attempt->answers as $answer)
    <div class="bg-white p-4 rounded shadow">
        <p class="font-semibold">
            {{ $loop->iteration }}. {{ $answer->question->question }}
        </p>

        <p class="mt-2 text-gray-700">
            <strong>Jawapan Student:</strong><br>
            {{ $answer->answer }}
        </p>

        @if($answer->question->type === 'mcq')
            <p class="mt-2 text-green-600">
                Markah: {{ $answer->marks }} / {{ $answer->question->marks }}
            </p>
        @else
            <div class="mt-3">
                <label class="block font-semibold">
                    Markah ({{ $answer->question->marks }} max)
                </label>
                <input
                    type="number"
                    name="marks[{{ $answer->id }}]"
                    value="{{ $answer->marks }}"
                    min="0"
                    max="{{ $answer->question->marks }}"
                    class="border rounded p-2 w-32"
                    required
                >
            </div>
        @endif
    </div>
@endforeach

<button class="bg-blue-600 text-white px-6 py-2 rounded">
    Simpan Markah
</button>

</div>
</form>
</x-app-layout>
