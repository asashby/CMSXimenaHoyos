<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FocusedExerciseItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'focused_exercise_id',
        'title',
        'description',
        'series',
        'repetitions',
        'video_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'desktop_image_url',
        'mobile_image_url',
    ];

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
}
