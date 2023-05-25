<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                'not_in:email',
                'regex:/^[\w.-]+$/'
            ],
            // Outras regras de validação aqui
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'username' => $this->input('username'),
            'gender' => $this->input('gender'),
            'birth_date' => $this->input('birth_date'),
        ]);
    }

  public function messages()
  {
    return [
        'username.required' => 'O campo "Username" é obrigatório.',
        'gender.required' => 'O campo "Gender" é obrigatório.',
        'gender.in' => 'O campo "Gender" deve ter um valor válido.',
        'profile_image.image' => 'O arquivo enviado para o campo "Profile Image" deve ser uma imagem.',
        'birth_date.required' => 'O campo "Birth Date" é obrigatório.',
        'birth_date.date' => 'O campo "Birth Date" deve ser uma data válida.',
    ];
  }
}