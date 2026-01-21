<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassRoom;

class ClassRoomSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            'Class 1A',
            'Class 1B',
            'Class 2A',
        ];

        foreach ($classes as $class) {
            ClassRoom::create([
                'name' => $class,
            ]);
        }
    }
}
