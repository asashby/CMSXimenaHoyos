<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequestPost extends FormRequest
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
            'course_id'=>'required|integer',
        ];

    }
    public function messages()
    {
        return [
            'title.required' => 'El título del Día es requerido',
            'course_id.required'=>'El reto es requerido',
        ];
    }
}
