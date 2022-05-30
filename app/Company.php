<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'helpCenter',
        'slug',
        'beforeRegister',
        'companyInfo'
    ];

    protected $casts = [
        "helpCenter" => "object",
        "companyInfo" => "object",
        "companySeo" => "object",
        "facebook" => "object",
        "google" => "object",
        "privacyPolicy" => "object",
    ];

    public function getCompanyInfo()
    {
        $company = Company::where('code', env('CODE_COMPANY'))->first();
        return $company;
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
