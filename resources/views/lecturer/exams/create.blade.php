<x-app-layout>
<x-slot name="header">
    <h2>Create Exam</h2>
</x-slot>

<div class="py-12 max-w-xl mx-auto">
<form method="POST" action="{{ route('lecturer.exams.store') }}"
      class="space-y-4">
@csrf

<input name="title" placeholder="Exam title"
       class="w-full border p-2" required>

<select name="subject_id" class="w-full border p-2">
@foreach($subjects as $subject)
<option value="{{ $subject->id }}">
    {{ $subject->name }}
</option>
@endforeach
</select>

<input
    id="duration"
    name="duration"
    type="number"
    min="1"
    max="1440"
    step="1"
    placeholder="Duration (minutes)"
    class="w-full border p-2"
    required
>



<button class="bg-blue-600 text-white px-4 py-2 rounded">
Create Exam
</button>
</form>
</div>
</x-app-layout>

<script>
document.getElementById('duration').addEventListener('input', function () {
    if (this.value > 1440) {
        this.value = 1440;
    }
    if (this.value < 1) {
        this.value = 1;
    }
});
</script>

