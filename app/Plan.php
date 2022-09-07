<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'months',
        'slug',
    ];

    protected $casts = [
        'product_id' => 'array',
        'slug' => 'array'
    ];

    protected $hidden = ['pivot'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_plans')->withPivot('id', 'course_id', 'plan_id');
    }

    public function focused_exercises()
    {
        return $this->belongsToMany(FocusedExercise::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeSlug($query, $slug)
    {
        $query->where('slug', 'like', "%$slug%");
    }
}
