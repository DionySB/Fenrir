<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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
            'postal_code' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'street' => 'required|string',
            'address_street' => 'required|string',
            'block' => 'nullable|string',
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
            'postal_code' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'street' => 'nullable|string',
            'address_street' => 'nullable|string',
            'block' => 'nullable|string',
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
            'postal_code.required' => 'O campo postal_code é obrigatório.',
            'province.required' => 'O campo province é obrigatório.',
            'city.required' => 'O campo city é obrigatório.',
            'district.required' => 'O campo district é obrigatório.',
            'street.required' => 'O campo street é obrigatório.',
            'street_address.required' => 'O campo street_address é obrigatório.',

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