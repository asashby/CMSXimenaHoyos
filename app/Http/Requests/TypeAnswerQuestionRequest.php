<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeAnswerQuestionRequest extends FormRequest
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
            'type_answer_id'=>'required',
            //'title' => 'required',
            'question_id' => 'required',
           // 'message' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'El título es requerido',
            'question_id.required' => 'La pregunta es requerida',
            'message.required' => 'El mensaje es requerido',
            'type_answer_id.required' => 'La respuesta  es requerida'
        ];
    }
}
