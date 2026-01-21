<x-app-layout>
<x-slot name="header">
    <h2>{{ $exam->title }}</h2>
</x-slot>

<div class="py-12 max-w-4xl mx-auto">
<form method="POST"
      action="{{ route('student.exams.submit',$exam) }}"
      id="submit-form">
@csrf

@foreach($exam->questions as $q)
<div class="bg-white p-4 shadow rounded mb-4">
    <strong>{{ $q->question }}</strong>

    @if($q->type === 'mcq')
        @foreach($q->options as $opt)
            <label class="block">
                <input type="radio"
                       name="answers[{{ $q->id }}]"
                       value="{{ $opt }}">
                {{ $opt }}
            </label>
        @endforeach
    @else
        <textarea name="answers[{{ $q->id }}]"
                  class="w-full border p-2"></textarea>
    @endif
</div>
@endforeach

<button class="bg-green-600 text-white px-6 py-2 rounded">
Submit
</button>
</form>
</div>
</x-app-layout>
