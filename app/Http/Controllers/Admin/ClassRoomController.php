<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index()
    {
        return view('admin.class-rooms.index', [
            'classes' => ClassRoom::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.class-rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        ClassRoom::create($request->all());

        return redirect()
            ->route('admin.class-rooms.index')
            ->with('success', 'Class berjaya ditambah');
    }

    public function edit(ClassRoom $classRoom)
    {
        return view('admin.class-rooms.edit', compact('classRoom'));
    }

    public function update(Request $request, ClassRoom $classRoom)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $classRoom->update($request->all());

        return redirect()
            ->route('admin.class-rooms.index')
            ->with('success', 'Class berjaya dikemaskini');
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();

        return back()->with('success', 'Class berjaya dipadam');
    }
}

