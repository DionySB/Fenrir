<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

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
}