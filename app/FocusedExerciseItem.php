<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FocusedExerciseItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'focused_exercise_id',
        'title',
        'video_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
