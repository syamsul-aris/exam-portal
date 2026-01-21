<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\ExamAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ADMIN
        if ($user->hasRole('Admin')) {
            return view('dashboard', [
                'totalUsers' => User::count(),
                'totalClasses' => ClassRoom::count(),
                'totalSubjects' => Subject::count(),
                'totalExams' => Exam::count(),
            ]);
        }

        // LECTURER
        if ($user->hasRole('Lecturer')) {
            $exams = Exam::where('lecturer_id', $user->id)->get();

            return view('dashboard', [
                'class' => $user->classRoom,
                // 'subjects' => $user->classes->flatMap->subjects->unique('id'),
                'totalExams' => $exams->count(),
                'totalSubmissions' => ExamAttempt::whereIn('exam_id', $exams->pluck('id'))
                    ->where('is_submitted', true)
                    ->count(),
            ]);
        }

        // STUDENT
        if ($user->hasRole('Student')) {
            return view('dashboard', [
                'class' => $user->classRoom,
                'subjects' => "", //optional($user->classRoom)->subjects ?? collect(),
                'availableExams' => Exam::where('is_active', true)
                    ->whereHas('classes', fn ($q) =>
                        $q->where('class_rooms.id', $user->class_room_id)
                    )->count(),
                'completedExams' => ExamAttempt::where('student_id', $user->id)
                    ->where('is_submitted', true)
                    ->count(),
            ]);
        }

        abort(403);
    }
}
