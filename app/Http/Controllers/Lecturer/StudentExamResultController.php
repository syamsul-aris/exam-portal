<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Exam;
use App\Models\ExamAttempt;

use App\Http\Controllers\Controller;

class StudentExamResultController extends Controller
{
    public function show(Exam $exam)
    {
        $attempt = ExamAttempt::with('answers.question')
            ->where('exam_id',$exam->id)
            ->where('student_id',auth()->id())
            ->firstOrFail();

        return view('student.exams.result', compact('exam','attempt'));
    }
}
