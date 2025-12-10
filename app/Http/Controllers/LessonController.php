<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Lesson;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::all();
        return view('lessons.index',compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = Lesson::all();
        return view('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'name' => 'required|string'
        ]);

        Lesson::create(['name' => $request->name]);

        return redirect()->route('lessons.index')
                         ->with('success', 'Lesson successfully created!');
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
        $lesson = Lesson::findOrFail($id);
        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name' => 'required|string'
        ]);

        $lessons = Lesson::findOrFail($id);
        $lessons->update(['name' => $request->name]);

          return redirect()->route('lessons.index')
                         ->with('success', 'Lesson successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Lesson::where('id', $id)->delete();

          return redirect()->route('lessons.index')
                         ->with('success', 'Lesson successfully deleted!');
    }

}
