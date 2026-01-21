<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Subject;
use App\Models\ExamAttempt;

class Exam extends Model
{
    protected $fillable = [
        'title','subject_id','class_room_id',
        'duration','starts_at','ends_at','is_active', 'lecturer_id'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classes()
{
    return $this->belongsToMany(
        ClassRoom::class,
        'class_exam',
        'exam_id',
        'class_room_id'
    );
}


public function attempts()
{
    return $this->hasMany(ExamAttempt::class);
}

    
}

