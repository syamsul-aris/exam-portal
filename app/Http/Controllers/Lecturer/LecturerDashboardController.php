<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Exam;;
use App\Models\ExamAttempt;
use App\Models\User;

class LecturerDashboardController extends Controller
{
    public function index()
    {
        return view('lecturer.dashboard',[
            'exams'=>Exam::where('lecturer_id',auth()->id())->count(),
            'students'=>User::role('Student')->count(),
            'attempts'=>ExamAttempt::count(),
        ]);
    }
}
