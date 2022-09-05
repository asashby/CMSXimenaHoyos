<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCourse extends Pivot
{
    public $table = 'user_courses';
    public $incrementing = true;

    protected $casts = [
        'expiration_date' => 'datetime',
    ];
}
