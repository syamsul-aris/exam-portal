<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller {

    public function index()
    {
        $lecturer = Auth::user();

        $exams = Exam::where('class_room_id', $lecturer->class_room_id)
            ->with('subject')
            ->get();

        return view('lecturer.exams.index', compact('exams'));
    }

    public function create()
    {
        $subjects = Subject::where(
            'class_room_id',
            Auth::user()->class_room_id
        )->get();

        return view('lecturer.exams.create', compact('subjects'));
    }
    
   public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'duration' => 'required|integer|min:1',
        ]);

        $exam = Exam::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'class_room_id' => Auth::user()->class_room_id,
            'duration' => $request->duration,
            'lecturer_id' => Auth::id(),
        ]);

        $exam->classes()->attach(Auth::user()->class_room_id);

        return redirect()->route('lecturer.exams.index')
            ->with('success', 'Exam created & assigned to class');
    }

    public function toggle(Exam $exam)
    {
        $exam->update([
            'is_active' => ! $exam->is_active
        ]);

        return back();
    }

}

