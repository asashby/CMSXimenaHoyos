<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
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

    /**
     * Validate current user has valid subscription to focused exercise by web guard
     */
    public function getCurrentUserIsSubcribedAttribute(): bool
    {
        if (Auth::guard('web')->check()) {
            return DB::table('focused_exercise_user')
                ->where('focused_exercise_id', $this->id)
                ->where('user_id', Auth::guard('web')->id())
                ->where('expiration_date', '>=', now()->format('Y-m-d H:i:s'))
                ->exists();
        }
        return false;
    }

    public static function getFocusedExercisesIdAndDisplayName(Request $request)
    {
        return self::query()->get([
            'id',
            'title AS display_name'
        ]);
    }
}
