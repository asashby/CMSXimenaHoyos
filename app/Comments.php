<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\updateRateChallenge;

class Comments extends Model
{
    use SoftDeletes;

    protected $table = 'comments';
    protected $fillable = ['id_user', 'title', 'content', 'course_id', 'rating'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActivatedScope);
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
