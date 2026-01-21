<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAnswer;;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;

class ExamMarkController extends Controller
{
    public function index(Exam $exam)
    {
        $attempts = ExamAttempt::with('answers.question','student')
            ->where('exam_id',$exam->id)->get();

        return view('lecturer.exams.mark', compact('exam','attempts'));
    }

    public function mark(Request $request, ExamAnswer $answer)
    {
        $answer->update(['marks'=>$request->marks]);

        $attempt = $answer->attempt;
        $attempt->score = $attempt->answers()->sum('marks');
        $attempt->save();

        return back();
    }
}
