<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';
    protected $fillable = ['id', 'title', 'description', 'price', 'course_id', 'slug', 'woocommerce_ids'];

    protected $casts = [
        'course_id' => 'array',
        'product_id' => 'array',
        'slug' => 'array'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_plans')->withPivot('id', 'course_id', 'plan_id');
    }

    /* public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActivatedScope);
    } */

    static function scopeCourse($query, $id)
    {
        $query->where('course_id', 'like', "%$id%");
    }

    public function scopeSlug($query, $slug)
    {
        $query->where('slug', 'like', "%$slug%");
    }
}
