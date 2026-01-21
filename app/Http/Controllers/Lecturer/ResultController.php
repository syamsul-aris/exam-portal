<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Exam;

class ResultController extends Controller
{
    public function index(Exam $exam)
    {
        $attempts = $exam->attempts()
            ->with('students','answers.question')
            ->get();

        return view('lecturer.results.index', compact('exam','attempts'));
    }
}

