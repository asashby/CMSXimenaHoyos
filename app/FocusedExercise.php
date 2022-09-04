<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FocusedExercise extends Model
{
    protected $table = 'focused_exercises';

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'video_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function focused_exercise_items()
    {
        return $this->hasMany(FocusedExerciseItem::class, 'focused_exercise_id');
    }

    public function getDesktopImageUrlAttribute()
    {
        if ($this->desktop_image) {
            return Storage::disk('public')->url($this->desktop_image);
        }
        return '';
    }

    public function getMobileImageUrlAttribute()
    {
        if ($this->mobile_image) {
            return Storage::disk('public')->url($this->mobile_image);
        }
        return '';
    }

    public static function getFocusedExercisesIdAndDisplayName(Request $request)
    {
        return self::query()->get([
            'id',
            'title AS display_name'
        ]);
    }
}
