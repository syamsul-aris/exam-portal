<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Exam $exam)
    {
        return view('lecturer.questions.index', [
            'exam' => $exam,
            'questions' => $exam->questions
        ]);
    }

    public function store(Request $request, Exam $exam)
    {
        $request->validate([
            'question' => 'required',
            'type' => 'required|in:mcq,text',
        ]);

        Question::create([
            'exam_id' => $exam->id,
            'question' => $request->question,
            'type' => $request->type,
            'options' => $request->type === 'mcq'
                ? json_encode($request->options)
                : null,
            'correct_answer' => $request->correct_answer ?? null,
            'marks' => $request->marks ?? null,
        ]);

        return back()->with('success','Question added');
    }
}
