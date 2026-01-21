<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user();

        $students = User::role('Student')
            ->where('class_room_id', $lecturer->class_room_id)
            ->get();

        return view('lecturer.students.index', compact('students'));
    }
}

