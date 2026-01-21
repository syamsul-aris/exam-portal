<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-semibold">
        Results: {{ $exam->title }}
    </h2>
</x-slot>

<div class="py-8 max-w-7xl mx-auto">
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th>No</th>
                <th class="p-3">Student</th>
                <th>Score</th>
                <th>Submitted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($attempts as $attempt)
            <tr class="border-t">
                <td class="p-3">{{ $loop->iteration }}</td>
                <td class="p-3">{{ $attempt->student->name }}</td>
                <td>{{ $attempt->score }} / {{ $attempt->max_score }}</td>
                <td>{{ $attempt->submitted_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a
                        href="{{ route('lecturer.exams.results.show', [$exam, $attempt]) }}"
                        class="text-blue-600 underline"
                    >
                        Grade
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
