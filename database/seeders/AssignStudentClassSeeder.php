<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ClassRoom;

class AssignStudentClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = ClassRoom::all();

        User::role('student')->get()->each(function ($student) use ($classes) {
            $student->update([
                'class_room_id' => $classes->random()->id,
            ]);
        });
    }
}
