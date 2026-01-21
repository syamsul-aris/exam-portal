<x-app-layout>
<x-slot name="header">
    <h2>Manage Questions – {{ $exam->title }}</h2>
</x-slot>

<div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div class="mb-4 text-green-600">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('lecturer.questions.store',$exam) }}"
      class="space-y-4 bg-white p-4 shadow rounded">
@csrf

<textarea name="question" class="w-full border p-2"
    placeholder="Question"></textarea>

<select name="type" id="type" class="border p-2 w-full">
    <option value="mcq">MCQ</option>
    <option value="text">Text</option>
</select>

<div id="mcq-options">
    @for($i=0;$i<4;$i++)
        <input name="options[]" class="w-full border p-2 my-1"
               placeholder="Option {{ $i+1 }}">
    @endfor
    <input name="correct_answer"
           class="w-full border p-2"
           placeholder="Correct Answer">
</div>

<input type="number" name="marks" class="w-full border p-2"
    placeholder="Marks"></input>

<button class="bg-blue-600 text-white px-4 py-2 rounded">
Add Question
</button>
</form>

<hr class="my-6">

@foreach($questions as $q)
<div class="bg-white p-3 rounded mb-2">
    {{ $loop->iteration }}. <strong>{{ $q->question }}</strong>
    <div class="text-sm text-gray-600">Type: {{ $q->type }}</div>
</div>
@endforeach

</div>
</div>
</x-app-layout>
