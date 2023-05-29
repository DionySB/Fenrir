<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function profileRules()
    {
        return [
            'username' => [
                'unique:profiles',
                'required',
                'string',
                'min:3',
                'max:50',
                'not_in:email',
                'regex:/^[\w.-]+$/',
            ],
            'gender' => 'required|in:Feminino,Masculino,Prefiro não dizer,Outro',
            'profile_image' => 'required|image',
            'birth_date' => 'required|date',
            'fitness_goals' => 'nullable|string',
            'fitness_level' => 'nullable|in:beginner,intermediate,advanced',
            'health_info' => 'nullable|string',
            'exercise_history' => 'nullable|string',
            'time_preferences' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'O campo username é obrigatório.',
            'username.string' => 'O campo username deve ser uma string.',
            'username.min' => 'O campo username deve ter no mínimo :min caracteres.',
            'username.max' => 'O campo username deve ter no máximo :max caracteres.',
            'username.not_in' => 'O username não pode ser "email".',
            'username.unique' => 'O username já está em uso.',
            'username.regex' => 'O campo "Username" só pode conter letras, números, underscores, pontos e hífens.',
            'gender.required' => 'O campo "Gender" é obrigatório.',
            'gender.in' => 'O campo "Gender" deve ter um valor válido.',
            'profile_image.image' => 'O arquivo enviado para o campo "Profile Image" deve ser uma imagem.',
            'birth_date.required' => 'O campo "Birth Date" é obrigatório.',
            'birth_date.date' => 'O campo "Birth Date" deve ser uma data válida.',
            'fitness_goals.string' => 'O campo "Objetivos fitness" deve ser uma string.',
            'fitness_level.in' => 'O campo "Nível de condicionamento físico" deve ter um valor válido.',
            'health_info.string' => 'O campo "Informações de saúde" deve ser uma string.',
            'exercise_history.string' => 'O campo "Histórico de exercícios" deve ser uma string.',
            'time_preferences.string' => 'O campo "Preferências de horário" deve ser uma string.',

        ];
    }
}
