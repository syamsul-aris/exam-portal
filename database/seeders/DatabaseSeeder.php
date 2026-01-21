<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,

            // ClassRoomSeeder::class,
            // SubjectSeeder::class,
            // ClassSubjectSeeder::class,
            // AssignStudentClassSeeder::class,
            // AssignLecturerClassSeeder::class,
        ]);
    }

}
