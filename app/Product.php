<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{

    use HasMediaTrait;

    protected $fillable = ["name", "slug", "attributes", "description", "price", "url_image", "sku"];


    protected $casts = [
        'attributes' => 'object',
    ];

    protected $hidden = [
        'pivot',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->withPivot('id', 'product_id', 'category_id');
    }


    public function scopeCategory($query, $category_id)
    {
        if ($category_id)
            return $query->whereHas('categories', function ($query) use ($category_id) {
                $query->where('categories.id', $category_id);
            });
    }

    public function scopeSearch($query, $search)
    {
        if ($search)
            return $query->where('name', 'LIKE', "%$search%");
    }
}
