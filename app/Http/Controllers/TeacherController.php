<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Teacher::create(['name' => $request->name]);

        return redirect()->route('teachers.index')
                         ->with('success', 'Teacher successfully created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update(['name' => $request->name]);

          return redirect()->route('teachers.index')
                         ->with('success', 'Teacher successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teacher::where('id', $id)->delete();

          return redirect()->route('teachers.index')
                         ->with('success', 'Teacher successfully deleted!');
    }
}
