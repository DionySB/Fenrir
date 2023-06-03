<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GymRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->store();
        } elseif ($this->isMethod('put')) {
            return $this->update();
        }

        return [];
    }

    /**
     * Get the validation rules for storing an address.
     *
     * @return array
     */

    public function store()
    {
        return [
            
            'name' => 'required|string',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'address_id' => 'required|string',
        ];
    }

    /**
     * Get the validation rules for updating an address.
     *
     * @return array
     */
    public function update()
    {
        return [
            'name' => 'nullable|string',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'address_id' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Informe um nome para a academia.',
            'address_id' => 'Informe um address_id para a academia.',
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
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}