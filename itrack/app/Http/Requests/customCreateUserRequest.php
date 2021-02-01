<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class customCreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->email === "dan@gmail.com";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required', 'string',
            'email' => 'required', 'email', 'unique:users',
            'designation' => 'required',
            'password' => 'required', 'min:8', 'confirmed',

        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Provide the full name of the new user!',
            'name.string' => 'Name of new user must be only alphabets a-zA-Z',
            'email.required' => 'Email address is required!',
            'email.unique:users' => 'Sorry, this email is taken!',
            'designation' => 'What is the new user\'s designation?',
            'password.required' => 'Password is required!',
            'password.min:6' => 'Password must be atleast 8 characters long!',
            'password.confirmed' => 'Sorry,the two passwords do not match!',
        ];
    }
}
