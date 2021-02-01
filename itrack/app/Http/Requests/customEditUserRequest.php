<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class customEditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'designation' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please tell us yoyr name!',
            'name.string' => 'Unacceptable name format. Only letters [a-zA-Z] are allowed!',
            'email.required' => 'Your email is required!',
            'email.email' => 'Invalid email format!',
            'designation.required' => 'Your designation is required!',
            'designation.string' => 'Your designation must be only characters [a-zA-Z0-9]!',
        ];
    }
}
