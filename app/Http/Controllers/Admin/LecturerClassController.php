<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class LecturerClassController extends Controller
{
    public function index()
    {
        return view('admin.lecturers.assign-class', [
            'lecturers' => User::role('Lecturer')->with('classRoom')->get(),
            'classes'   => ClassRoom::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        $user->update([
            'class_room_id' => $request->class_room_id,
        ]);

        return back()->with('success', 'Lecturer berjaya di-assign ke class');
    }
}

