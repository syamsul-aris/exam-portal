<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\ClassRoom;

class SubjectSeeder extends Seeder
{

public function run(): void
{
    $class = ClassRoom::first();

    $subjects = [
        'Database',
        'Web Programming',
        'Software Engineering',
    ];

    foreach ($subjects as $subject) {
        Subject::create([
            'name' => $subject,
            'class_room_id' => $class->id,
        ]);
    }
}

}
