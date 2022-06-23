<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class Product extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $casts = [
        'attributes' => 'object',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'section_id');
    }

    public function photos()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
