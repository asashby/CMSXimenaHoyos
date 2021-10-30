<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequestPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title' => 'required',
            'file_url'=>'mimes:pdf',
            'url_image'=>'mimes:png,jpg,jpeg,gif',
            'banner'=>'mimes:png,jpg,jpeg,gif',
            'attributes'=>'json',
        ];

    }
    public function messages()
    {
        return [
            'title.required' => 'El título del curso es requerido',
            'file_url.mimes'=>'El formato del archivo debe ser pdf',
            'url_image.mimes'=>'El formato de la imagen no es válido',
            'banner.mimes'=>'El formato de la imagen no es válido'
        ];
    }
}
