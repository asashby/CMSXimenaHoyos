<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostRequest extends FormRequest
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

        $emailRule = Rule::unique((new User)->getTable());

        if (request()->isMethod('put')) {
            $emailRule->ignore($this->route('user'));
            return [
                'name' => 'required|string|min:2',
                'sur_name' => 'required|string|min:2',
                'email' => ['required','email',$emailRule],
            ];

        }
        if (request()->isMethod('post')) {
            return [
                'name' => 'required|string|min:2',
                'sur_name'=>'required|string|min:2',
                'email'=>'required|email|unique:users'
            ];

        }

    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string'=>'El nombre ingresado no es válido',
            'name.min'=>'El nombre debe tener mínimo 2 carácteres',
            'sur_name.required' => 'El apellido es requerido',
            'sur_name.string'=>'El apellido ingresado no es válido',
            'sur_name.min'=>'El apellido debe tener mínimo 2 carácteres',
            'email.required' => 'El email es requerido',
            'email.string'=>'El email ingresado no es válido',
            'email.unique'=>'El email  actualmente ya esta en uso'
        ];
    }
}
