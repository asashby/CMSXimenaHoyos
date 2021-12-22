<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $table = 'plans';
    protected $fillable = ['title', 'description', 'price', 'course_id'];

    protected $casts = [
        'course_id' => 'array',
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
}
