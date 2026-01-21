<?php

namespace App\Services\Exam;

use Carbon\Carbon;
use App\Models\ExamAttempt;

class ExamTimerService
{
    public function isTimeExpired(ExamAttempt $attempt): bool
    {
        return now()->greaterThan(
            Carbon::parse($attempt->started_at)
                ->addMinutes($attempt->exam->duration)
        );
    }
}
