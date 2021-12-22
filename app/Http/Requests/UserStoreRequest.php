<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'identification' => 'required|numeric|min:5|unique:users,identification,'.$this->id,
            'address' => 'required|min:5',
            'phone' => 'required|numeric|min:10',
            'role' => 'required',
            'state' => 'required',
            'email' => 'email|unique:users,email,'.$this->id,
            'password' => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'name.*' => 'the name must be at least 3 characters',
            'last_name.*' => 'the last name must be at least 3 characters',
            'identification.*' => 'the identification must be a number and have at least 5 characters',
            'address.*' => 'the address must be at least 3 characters',
            'phone.*' => 'the phone must be a number and have at least 10 characters',
            'role.required' => 'the role is required',
            'state.required' => 'the state is required',
            'email.email' => 'the email must be a valid email address',
            'email.unique'=>'the email has already been taken',
            'password' => 'the password is required',
        ];
    }
}
