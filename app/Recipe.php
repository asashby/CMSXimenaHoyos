<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use SoftDeletes;

    protected $table = 'recipes';

    protected $fillable = [
        'id',
        'title',
        'description',
        'slug',
        'route',
        'ingredients',
        'steps',
        'attributes',
        'images',
        'page_image',
        'url_video',
        'image_content',
        'published_at'
    ];

    protected $casts = [
        'nutritional_facts' => 'object',
        'ingredients' => 'object',
        'steps' => 'object'
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class, 'recipe_course')->withPivot('course_id');
    }

    public function cleanSlug($title)
    {
        $title = str_replace('á', 'a', $title);
        $title = str_replace('Á', 'A', $title);
        $title = str_replace('é', 'e', $title);
        $title = str_replace('É', 'E', $title);
        $title = str_replace('í', 'i', $title);
        $title = str_replace('Í', 'I', $title);
        $title = str_replace('ó', 'o', $title);
        $title = str_replace('Ó', 'O', $title);
        $title = str_replace('Ú', 'U', $title);
        $title = str_replace('ú', 'u', $title);

        //Quitando Caracteres Especiales
        $title = str_replace('"', '', $title);
        $title = str_replace(':', '', $title);
        $title = str_replace('.', '', $title);
        $title = str_replace(',', '', $title);
        $title = str_replace(';', '', $title);
        return $title;
    }

    public function scopeTime($query, $time)
    {
        if ($time)
            return $query->where('time_food', $time);
    }

    public function scopeTitle($query, $title)
    {
        if ($title)
            return $query->where('title', 'LIKE', "%$title%");
    }
}
