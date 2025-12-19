<?php

namespace App\Observers;

use App\Models\Question;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class QuestionObserver
{
    /**
     * Handle the Question "created" event.
     */
    public function created(Question $question): void
    {
        if ($question->type == 'mock'){
            $students = User::role('student')->get();

            foreach ($students as $student){
                Mail::to($student->email)->send(new TestMail($question));
            }
        }
    }

}
