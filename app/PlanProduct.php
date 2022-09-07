<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlanProduct extends Pivot
{
    public $incrementing = true;
    public $timestamps = false;
}
