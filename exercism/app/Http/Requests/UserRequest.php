<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * 
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required_with:password|same:password'
        ];
    }

    public function store()
    {
        return [
            'name',
            'email',
        ];
    }

    public function update()
    {
        return [
            'name' => 'nullable|string',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('id'))
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }
    /**
     * 
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail fornecido não é válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function failedValidation($validator)
    {
        $errors = $validator->errors()->toArray();
        throw new \Illuminate\Validation\ValidationException($validator, response()->json($errors, 422));
    }
}