<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'attributes' => 'object',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'section_id');
    }
}
