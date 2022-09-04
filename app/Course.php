<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'courses';
    protected $fillable = ['title', 'ext_id', 'prices', 'subtitle', 'type', 'url_image', 'mobile_image', 'days', 'level', 'frequency', 'is_activated', 'slug', 'banner', 'file_url', 'attributes'];

    protected $hidden = [
        'pivot',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActivatedScope);
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'course_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses')
            ->withPivot('id', 'init_date', 'final_date', 'insc_date', 'flag_registered', 'flag_completed', 'paid');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'courses_plans')
            ->withPivot('id', 'course_id', 'plan_id')
            ->select(['plans.id', 'plans.title', 'plans.price', 'plans.description']);
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

    public function scopeTitle($query, $title)
    {
        if ($title)
            return $query->where('title', 'LIKE', "%$title%");
    }
}
