<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(QuestionItem::class);
    }

}
