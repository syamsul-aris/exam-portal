<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;

class ExamSubmitController extends Controller
{
    public function submit(Request $request, Exam $exam)
    {
        $attempt = ExamAttempt::where([
            'exam_id' => $exam->id,
            'user_id' => auth()->id()
        ])->firstOrFail();

        foreach ($request->answers as $question_id => $answer) {
            ExamAnswer::updateOrCreate(
                [
                    'exam_attempt_id' => $attempt->id,
                    'question_id' => $question_id
                ],
                ['answer' => $answer]
            );
        }

        // AUTO MARK MCQ
        $score = 0;
        foreach ($exam->questions as $q) {
            if ($q->type === 'mcq') {
                $ans = $attempt->answers
                    ->where('question_id',$q->id)
                    ->first();
                if ($ans && $ans->answer === $q->correct_answer) {
                    $score++;
                }
            }
        }

        $attempt->update([
            'submitted_at' => now(),
            'score' => $score
        ]);

        return redirect()->route('student.exams.index');
    }
}
