<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use App\Models\Subject;

class ClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ClassRoom::all();
        $subjects = Subject::all();

        foreach ($classes as $class) {
            // setiap class ambil 2 subjek
            $class->subjects()->sync(
                $subjects->random(2)->pluck('id')->toArray()
            );
        }
    }
}
