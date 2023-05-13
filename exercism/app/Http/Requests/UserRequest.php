<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    public function rules(){
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            //... outras regras
        ];
    }

    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function store()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            //… more validation
        ];
    }

    public function update()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user()->id

        ];
    }

    public function destroy()
    {
        return [
            'id' => 'required|integer|exists:users,id'
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