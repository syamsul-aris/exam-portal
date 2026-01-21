<?php

namespace App\Services\Exam;

use App\Models\Exam;

class ExamService
{
    public function listForLecturer(int $lecturerId)
    {
        return Exam::where('lecturer_id', $lecturerId)
            ->latest()
            ->get();
    }

    public function create(array $data): Exam
    {
        return Exam::create([
            'title'        => $data['title'],
            'subject_id'   => $data['subject_id'],
            'duration'     => $data['duration'],
            'lecturer_id'  => auth()->id(),
        ]);
    }
}
