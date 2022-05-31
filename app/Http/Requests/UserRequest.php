<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'     =>  'required|min:5|max:100',
            'password'     =>  'required|string|min:8',
            'email'     =>  'required|string|min:5|unique:users',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Введите :attribute (Имя обязательно)',
            'name.min' => 'Минимальная длина имени [:min] символов',
            'name.max' => 'Максимальная длина имени [:max] символов',


            'password.required' => 'Введите :attribute (Пароль обязательное поле)',
            'password.min' => 'Минимальная длина имени [:min] символов',

            'email.string' => 'Некоректные данные',
            'email.min' => 'Минимальная длина почты [:min] символов',
            'email.unique' => 'Такая почта уже зарегестрированна',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'password' => 'Пароль',
            'email' => 'Эл почта',
        ];
    }
}
