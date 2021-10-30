<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAnswer extends Model
{
    use SoftDeletes;

    protected $table = 'type_answers';
    protected $fillable = ['name', 'url_image', 'confirm_answer', 'series', 'reps'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'type_answers_questions')->withPivot(['id','title', 'message', 'status', 'type_answer_valid', 'type_answer_id', 'question_id']);
    }
}
