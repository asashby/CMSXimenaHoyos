<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Focused extends Model
{
    protected $table = 'focused_exercises';

    protected $fillable = [
        'title', 'slug', 'subtitle', 'video_url', 'description'
    ];

    public function focused_exercise_items()
    {
        return $this->hasMany(FocusedExerciseItem::class, 'focused_exercise_id');
    }
}
