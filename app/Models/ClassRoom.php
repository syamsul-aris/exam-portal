<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;;
use App\Models\Subject;

class ClassRoom extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    public function student_users()
    {
        return $this->hasMany(User::class);
    }

public function subjects()
{
    return $this->belongsToMany(
        Subject::class,
        'class_subject',
        'class_room_id',
        'subject_id'
    );
}


public function exams()
{
    return $this->belongsToMany(
        Exam::class,
        'class_exam',
        'class_room_id',
        'exam_id'
    );
}

}
