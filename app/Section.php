<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   

class Section extends Model
{
    use SoftDeletes;

    public function articles(){
        return $this->hasMany('App\Article', 'section_id', 'id','name', 'description')->latest()->take(5)->select('id', 'title', 'subtitle', 'page_image', 'slug', 'text_link');
    }

    public function cleanSlug($title) 
    { 
        $s = str_replace('á', 'a', $title); 
        $s = str_replace('Á', 'A', $title); 
        $s = str_replace('é', 'e', $title); 
        $s = str_replace('É', 'E', $title); 
        $s = str_replace('í', 'i', $title); 
        $s = str_replace('Í', 'I', $title); 
        $s = str_replace('ó', 'o', $title); 
        $s = str_replace('Ó', 'O', $title); 
        $s = str_replace('Ú', 'U', $title); 
        $s= str_replace('ú', 'u', $title); 

        //Quitando Caracteres Especiales 
        $s= str_replace('"', '', $title); 
        $s= str_replace(':', '', $title); 
        $s= str_replace('.', '', $title); 
        $s= str_replace(',', '', $title); 
        $s= str_replace(';', '', $title); 
        return $title; 
    }
}
