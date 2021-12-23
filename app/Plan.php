<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';
    protected $fillable = ['title', 'description', 'price', 'course_id', 'slug'];

    protected $casts = [
        'course_id' => 'array',
        'slug' => 'array'
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActivatedScope);
    }

    public function scopeCourse($query, $id)
    {
        $query->where('course_id', 'like', "%$id%");
    }

    public function scopeSlug($query, $slug)
    {
        $query->where('slug', 'like', "%$slug%");
    }
}
