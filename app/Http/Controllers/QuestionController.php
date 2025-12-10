<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\QuestionItem;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Teacher;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        $lessons = Lesson::all();
        return view('questions.create', ['teachers' => $teachers, 'lessons' => $lessons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'lesson_id' => 'required|exists:lessons,id',
            'items_text' => 'required|array|min:1',
            'items_text.*' => 'required|string|max:1000',
            'items_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|in:daily,mock',
            'duration_time' => $request->type === 'mock' ? 'required|integer|min:1' : 'nullable',
            'until_time' => $request->type === 'mock' ? 'required|date' : 'nullable',
        ]);

        // Asosiy question saqlaymiz
        $question = Question::create([
            'name' => $validated['name'],
            'teacher_id' => $validated['teacher_id'],
            'lesson_id' => $validated['lesson_id'],
            'type' => $validated['type'],
            'duration_time' => $validated['duration_time'],
            'until_time' => $validated['until_time'],
        ]);

        // Repeater itemlarini saqlaymiz
        foreach ($validated['items_text'] as $index => $text) {
            $imagePath = null;

            if ($request->hasFile('items_image') && isset($request->file('items_image')[$index])) {
                $imagePath = $request->file('items_image')[$index]->store('question_items', 'public');
            }

            QuestionItem::create([
                'question_id' => $question->id,
                'question_text' => $text,
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
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
    public function edit($id)
    {
        $question = Question::with('items')->findOrFail($id);
        $teachers = Teacher::all();
        $lessons = Lesson::all();

        return view('questions.edit', compact('question', 'teachers', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'lesson_id' => 'required|exists:lessons,id',
            'items' => 'required|array|min:1',
            'items.*' => 'required|string|max:1000',
        ]);

        $question = Question::findOrFail($id);

        // Asosiy savolni yangilaymiz
        $question->update([
            'name' => $validated['name'],
            'teacher_id' => $validated['teacher_id'],
            'lesson_id' => $validated['lesson_id'],
        ]);

        // Eski itemlarni o‘chiramiz va yangilarini qaytadan saqlaymiz
        $question->items()->delete();

        foreach ($validated['items'] as $item) {
            QuestionItem::create([
                'question_id' => $question->id,
                'question_text' => $item,
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          Question::where('id', $id)->delete();

          return redirect()->route('questions.index')
                         ->with('success', 'Question successfully deleted!');
    }
}
