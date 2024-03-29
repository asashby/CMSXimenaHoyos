<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait, SoftDeletes;

    protected $fillable = [
        "name",
        "slug",
        "attributes",
        "description",
        "price",
        "url_image",
        "sku",
        "is_active",
        "stock",
    ];

    protected $casts = [
        'attributes' => 'object',
        'price' => 'float',
        'stock' => 'float',
    ];

    protected $hidden = [
        'pivot',
    ];

    public function getFormattedStockAttribute(): string
    {
        return number_format($this->stock, 2);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->withPivot('id', 'product_id', 'category_id');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
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

    public static function getProductsIdAndDisplayName(Request $request)
    {
        return self::query()->get([
            'id',
            'name AS display_name',
        ]);
    }
}
