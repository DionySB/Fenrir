<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function registerRules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*]*$/',
            'password_confirmation' => 'required|same:password',
            'address.postal_code' => 'required|string',
            'address.province' => 'required|string',
            'address.city' => 'required|string',
            'address.district' => 'required|string',
            'address.street' => 'required|string',
            'address.block' => 'nullable|string',
            'address_id' => 'uuid|nullable',
            'profile_id' => 'uuid|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.',
            'name.string' => 'O campo de nome deve ser uma string.',
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'O campo de e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail fornecido já está em uso.',
            'password.required' => 'O campo de senha é obrigatório.',
            'password.string' => 'O campo de senha deve ser uma string.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.regex' => 'A senha deve conter no mínimo 6 caracteres, incluindo pelo menos uma letra e um número. Os seguintes símbolos são permitidos: !@#$%^&*',
            'password_confirmation.required' => 'O campo de confirmação de senha é obrigatório.',
            'password_confirmation.same' => 'O campo de confirmação de senha deve ser igual ao campo de senha.',
            // Adicione outras mensagens de erro personalizadas aqui...
        ];
    }
    

    
}

