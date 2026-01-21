<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'code',
        'class_room_id',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
