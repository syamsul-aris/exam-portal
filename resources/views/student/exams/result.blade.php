<x-app-layout>
<x-slot name="header">Result: {{ $exam->title }}</x-slot>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-4 rounded shadow">

                    <p>Total: {{ $attempt->score }} / {{ $attempt->max_score }}</p>

                    @foreach($attempt->answers as $ans)
                    <div class="border p-3 my-2">
                    <b>{{ $loop->iteration }}. {{ $ans->question->question }}</b><br>
                    Answer: {{ $ans->answer }}<br>
                    Mark: {{ $ans->marks ?? 'Pending' }}
                    </div>
                    @endforeach

                    
                </div>
                <button class="px-2 py-1 mt-3 rounded text-white bg-blue-600">
                        <a href="{{ route('student.exams.index') }}"
                            >
                            Kembali
                        </a>
                </button>
            </div>
        </div>
</x-app-layout>
