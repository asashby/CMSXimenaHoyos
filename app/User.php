<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'addittional_info' => 'object',
        'courses_free' => 'array'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_courses')->withPivot('id', 'user_id', 'course_id', 'init_date', 'final_date', 'insc_date', 'flag_registered', 'flag_completed');
    }
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_users_course')->withPivot('id', 'unit_id', 'questions', 'flag_complete_unit', 'date_answered');
    }
    public function progress()
    {
        return $this->belongsToMany(Question::class, 'user_questions_answers')->withPivot(['id', 'user_id', 'question_id', 'answer_id', 'sets', 'flag_complete_question']);
    }
    public function address()
    {
        return $this->hasMany('App\Addresses', 'user_id')->select(
            'id',
            'alias',
            'address',
            'user_id',
            'flag_default',
            'nro',
            'province',
            'district'
        );
    }
}
