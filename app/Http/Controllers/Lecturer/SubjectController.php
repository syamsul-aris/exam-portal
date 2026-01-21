<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('lecturer.subjects.index', [
            'subjects' => Subject::with('classRoom')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('lecturer.subjects.create', [
            'classes' => ClassRoom::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        Subject::create($request->all());

        return redirect()
            ->route('lecturer.subjects.index')
            ->with('success', 'Subjek berjaya dicipta');
    }

    public function edit(Subject $subject)
    {
        return view('lecturer.subjects.edit', [
            'subject' => $subject,
            'classes' => ClassRoom::all(),
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        $subject->update($request->all());

        return redirect()
            ->route('lecturer.subjects.index')
            ->with('success', 'Subjek berjaya dikemaskini');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return back()->with('success', 'Subjek berjaya dipadam');
    }
}
