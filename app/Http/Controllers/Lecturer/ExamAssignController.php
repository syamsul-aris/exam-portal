<?php

namespace App\Http\Controllers\Lecturer;


use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ExamAssignController extends Controller
{
    public function edit(Exam $exam)
    {
        $classes = ClassRoom::all();
        return view('lecturer.exams.assign', compact('exam','classes'));
    }

    public function update(Request $request, Exam $exam)
    {
        $exam->classes()->sync($request->class_ids ?? []);
        return back()->with('success','Class assigned');
    }
}
