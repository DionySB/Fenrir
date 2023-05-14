<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function rules()
    {
        $uuid = $this->route('id');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$uuid,
            'password' => 'sometimes|confirmed|min:8',
            'active' => 'sometimes|boolean',
            'password_confirmation' => 'sometimes|min:8',
        ];
    }
    
    public function rulesForTrash()
    {
        $uuid = $this->route('id');
        return [
            'id' => 'required|exists:users,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Os dados da requisição são inválidos.',
            'errors' => $validator->errors(),
        ], 422));
    }
}