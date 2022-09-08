<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FocusedExerciseUser extends Pivot
{
    public $incrementing = true;

    protected $casts = [
        'expiration_date' => 'date'
    ];
}
