<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use softDeletes;

    protected $table = 'questions';
    protected $fillable = ['id', 'title', 'code', 'slug', 'subtitle', 'is_activated', 'content', 'unit_id', 'duration', 'level', 'frequency', 'max_time', 'time_rest', 'url_video', 'mobile_image', 'url_image', 'order'];

    public static function booted()
    {
        static::addGlobalScope(new ActivatedScope);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function type_answers()
    {
        return $this->belongsToMany(TypeAnswer::class, 'type_answers_questions')->withPivot(['id', 'title', 'message', 'status', 'type_answer_valid', 'type_answer_id', 'question_id']);
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
