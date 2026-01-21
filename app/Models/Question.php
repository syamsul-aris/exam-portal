<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionOption;

class Question extends Model
{
    protected $fillable = [
        'exam_id','question','type','options','correct_answer','marks'
    ];

    public function getOptionsAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return json_decode($value, true) ?? [];
    }
}



