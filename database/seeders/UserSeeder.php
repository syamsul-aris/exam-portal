<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Lecturer (5)
        User::factory()
            ->count(5)
            ->create()
            ->each(fn ($user) => $user->assignRole('lecturer'));

        // Student (20)
        User::factory()
            ->count(20)
            ->create()
            ->each(fn ($user) => $user->assignRole('student'));
    }
}
