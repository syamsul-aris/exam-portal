<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerExamResultController extends Controller
{
    /**
     * List student results
     */
    public function index(Exam $exam)
    {
        $attempts = ExamAttempt::with('student')
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true)
            ->get();

        return view('lecturer.exams.results.index', compact('exam', 'attempts'));
    }

    /**
     * View & grade attempt
     */
    public function show(Exam $exam, ExamAttempt $attempt)
    {
        abort_if($attempt->exam_id !== $exam->id, 404);

        $attempt->load([
            'student',
            'answers.question',
        ]);

        return view('lecturer.exams.results.show', compact('exam', 'attempt'));
    }

    /**
     * Save manual grading
     */
    public function grade(Request $request, Exam $exam, ExamAttempt $attempt)
    {
        DB::transaction(function () use ($request, $attempt) {

            $totalScore = 0;

            foreach ($attempt->answers as $answer) {

                if ($answer->question->type === 'text') {

                    $marks = (int) ($request->marks[$answer->id] ?? 0);

                    $marks = min($marks, $answer->question->marks);

                    $answer->update([
                        'mark' => $marks,
                    ]);
                }

                $totalScore += $answer->mark ?? 0;
            }

            $attempt->update([
                'score' => $totalScore,
                'is_graded' => true,
            ]);
        });

        return redirect()
            ->route('lecturer.exams.results', $exam)
            ->with('success', 'Markah berjaya disimpan');
    }

}
