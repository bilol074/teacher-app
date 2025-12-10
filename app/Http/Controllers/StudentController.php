<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Student::create([
            'name' => $request->name,
        ]);

        return redirect()->route('students.index')
                         ->with('success', 'Student successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
        ]);

        return redirect()->route('students.index')
                         ->with('success', 'Student successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::where('id', $id)->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Student successfully deleted!');
    }
}
