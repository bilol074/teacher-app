<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserAnswerController extends Controller
{
    public function index(Request $request)
    {
        $lessons = Lesson::all();
        $selectedLesson = $request->lesson_id;
        $selectedQuestion = $request->question_id;
        $selectedType = $request->type;

        $questions = collect();
        $allQuestions = collect();

        if ($selectedLesson) {
            $query = Question::where('lesson_id', $selectedLesson);
            if (!empty($selectedType)) {
                $query->where('type', $selectedType);
            }
            $allQuestions = $query->get();
        }

        if ($selectedLesson && $selectedQuestion) {
            $questions = Question::where('lesson_id', $selectedLesson)
                ->whereHas('items', function ($query) use ($selectedQuestion) {
                    return $query->where('question_id', $selectedQuestion);
                })
                ->get();
        }

        return view('answers.index', compact('lessons', 'selectedLesson', 'questions', 'selectedQuestion', 'allQuestions', 'selectedType'));
    }

    /**
     * 2️⃣ Lesson tanlanganda yoki savol o'zgarganda qaytish
     */
    public function setAnswer(Request $request)
    {
        // Bu method faqat parametrlar bilan index sahifasiga yo'naltiradi.
        return redirect()->route('answers.index', [
            'lesson_id' => $request->lesson_id,
            'question_id' => $request->question_id,
            'type'=> $request->type
        ]);
    }

    /**
     * 3️⃣ Javoblarni saqlash
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'answers' => 'required|array',
            'answers.*' => 'required|string|max:1000',
        ]);

        foreach ($request->answers as $questionItemId => $answerText) {
            UserAnswer::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'question_id' => $request->question_id,
                    'question_item_id' => $questionItemId
                ],
                [
                    'answers' => $answerText, // 'answers' ustuni
                ]
            );
        }

        return back()->with('success', 'Javoblar muvaffaqiyatli saqlandi!');
    }

    // 4️⃣ Barcha javoblarni ko‘rish
    public function viewAnswers(Request $request)
    {
        $lessons = Lesson::all();
        $selectedLesson = $request->lesson_id;
        $selectedQuestion = $request->question_id;
        $selectedUser = $request->user_id;

        $allQuestions = collect();
        $answers = collect();
        $users = User::all(); // barcha foydalanuvchilar

        // Lesson tanlangan bo‘lsa, barcha savollarni olib kelamiz
        if ($selectedLesson) {
            $allQuestions = Question::where('lesson_id', $selectedLesson)->get();
        }

        // Javoblar faqat savol va o‘quvchi tanlanganda olinadi
        if ($selectedLesson && $selectedQuestion && $selectedUser) {
            $answers = UserAnswer::with(['user', 'question.items', 'questionItem'])
                ->where('question_id', $selectedQuestion)
                ->where('user_id', $selectedUser)
                ->get();
        }

        return view('answers.view', compact(
            'lessons',
            'selectedLesson',
            'selectedQuestion',
            'allQuestions',
            'answers',
            'users',
            'selectedUser'
        ));
    }



}

