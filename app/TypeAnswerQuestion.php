<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeAnswerQuestion extends Model
{
    protected $table = 'type_answers_questions';
    protected $fillable = ['title', 'message', 'status', 'type_answer_valid', 'type_answer_id', 'question_id'];


}
