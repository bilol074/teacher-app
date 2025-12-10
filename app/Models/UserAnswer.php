<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function questionItem()
    {
        return $this->belongsTo(QuestionItem::class);
    }

}
