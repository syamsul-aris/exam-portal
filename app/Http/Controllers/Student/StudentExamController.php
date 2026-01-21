<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;;
use App\Services\ExamAccessService;

class StudentExamController extends Controller
{
    public function index(ExamAccessService $accessService)
    {
        $student = auth()->user();

        $exams = Exam::whereHas('subject', function ($q) use ($student) {
            $q->whereIn('class_room_id', $student->classRooms->pluck('id'));
        })->get();

        return view('student.exams.index', compact('exams'));
    }
}
