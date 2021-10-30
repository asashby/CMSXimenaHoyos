<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'slug',
        'route',
        'admin_id',
        'content',
        'section_id',
        'content',
        'page_image',
        'published_at'
    ];


    protected $casts = [
        'addittional_info' => 'object',
    ];

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
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
}
