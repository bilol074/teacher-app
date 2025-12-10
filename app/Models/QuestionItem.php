<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionItem extends Model
{
    protected $table = 'question_items';
    protected $guarded = [];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->hasOne(UserAnswer::class );
    }
}
