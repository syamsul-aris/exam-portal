<?php

namespace App\Services\Exam;

use App\Models\Exam;

class ExamAccessService
{
    public function canStudentAccessExam($student, Exam $exam): bool
    {
        return $student->classRooms
            ->pluck('id')
            ->contains($exam->subject->class_room_id);
    }
}
