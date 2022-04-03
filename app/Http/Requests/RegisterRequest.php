<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ];
    }

    public function message() {
        // $messages = array (
            return [
            'name.min' => 'Name min is 3',
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Custom Message',
            'password.required' => 'Password is required'
        // );
            ];
        // return $messages;
    }
}
