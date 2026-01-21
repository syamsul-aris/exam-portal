<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ClassRoom;

class AssignLecturerClassSeeder extends Seeder
{
    public function run(): void
    {
        $lecturers = User::role('lecturer')->get();
        $classes = ClassRoom::all();

        foreach ($lecturers as $lecturer) {
            $lecturer->classes()->sync(
                $classes->random(2)->pluck('id')->toArray()
            );
        }
    }
}
