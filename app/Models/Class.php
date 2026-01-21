<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
