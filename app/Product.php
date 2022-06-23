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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->withPivot('id', 'product_id', 'category_id');
    }

    public function photos()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function scopeCategory($query, $category_id)
    {
        if ($category_id)
            return $query->whereHas('categories', function ($query) use ($category_id) {
                $query->where('categories.id', $category_id);
            });
    }

    public function scopeTitle($query, $title)
    {
        if ($title)
            return $query->where('title', 'LIKE', "%$title%");
    }
}
