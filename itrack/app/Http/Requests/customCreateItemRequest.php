<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class customCreateItemRequest extends FormRequest
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
            'item_name' => 'required|string|unique:items,item_name',
            'unit' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'item_name.required' => 'Please provide a name for the new item!',
            'item_name.string' => 'Name must be latin characters [A-Za-z0-9]!',
            'item_name.unique' => "Sorry, this item already exists!",
            'unit.required' => 'Select a unit for the item!',
        ];
    }
}
