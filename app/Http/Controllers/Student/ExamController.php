<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * LIST EXAMS
     */
    public function index()
    {
        $student = Auth::user();

        $exams = Exam::where('is_active', true)
            ->whereHas('classes', function ($q) use ($student) {
                $q->where('class_rooms.id', $student->class_room_id);
            })
            ->with(['attempts' => function ($q) use ($student) {
                $q->where('student_id', $student->id);
            }])
            ->get();

        return view('student.exams.index', compact('exams'));
    }

    /**
     * SHOW EXAM (ANSWER PAGE)
     */
   public function show(Exam $exam)
    {
        abort_if(!$exam->is_active, 403);

        $attempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        if (!$attempt->started_at || !$attempt->ended_at) {
            return redirect()->route('student.exams.index')
                ->with('error', 'Sila tekan Start Exam dahulu');
        }

       if (now()->greaterThan($attempt->ended_at) && $attempt->is_submitted) {
            return redirect()->route('student.exams.index')
                ->with('error', 'Exam telah tamat');
        }

        $exam->load('questions');

        return view('student.exams.show', compact('exam', 'attempt'));
    }


    /**
     * SUBMIT EXAM
     */
    public function submit(Request $request, Exam $exam)
    {
        $attempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', Auth::id())
            ->firstOrFail();

        abort_if($attempt->is_submitted, 403);

        DB::transaction(function () use ($request, $exam, $attempt) {

            $totalScore = 0;
            $maxScore = 0;

            foreach ($exam->questions as $question) {

                $answerInput = $request->input("answers.{$question->id}");
                $marks = null;

                if ($question->type === 'mcq') {
                    $marks = ($answerInput === $question->correct_answer)
                        ? $question->marks
                        : 0;
                }

                if ($question->type === 'text') {
                    $marks = null;
                }

                ExamAnswer::updateOrCreate(
                    [
                        'exam_attempt_id' => $attempt->id,
                        'question_id' => $question->id,
                    ],
                    [
                        'answer' => $answerInput,
                        'marks' => $marks,
                    ]
                );

                if (!is_null($marks)) {
                    $totalScore += $marks;
                }

                $maxScore += $question->marks;
            }

            $attempt->update([
                'score' => $totalScore,
                'max_score' => $maxScore,
                'is_submitted' => true,
                'submitted_at' => now(),
            ]);
        });

        return redirect()
            ->route('student.exams')
            ->with('success', 'Exam berjaya dihantar');
    }


    public function start(Exam $exam)
    {
        $student = Auth::user();

        $attempt = ExamAttempt::firstOrCreate(
            [
                'exam_id' => $exam->id,
                'student_id' => $student->id,
            ]
        );

        // Prevent restart
        if ($attempt->started_at) {
            return redirect()->route('student.exams.show', $exam->id);
        }

        $attempt->update([
            'started_at' => now(),
            'ended_at' => now()->addMinutes($exam->duration),
        ]);

        return redirect()->route('student.exams.show', $exam->id);
    }
}
