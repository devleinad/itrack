<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class customIssueItemRequest extends FormRequest
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
            'item_id' => 'required',
            'quantity' => 'required|numeric',
            'receiver' => 'required',

        ];
    }


    public function messages()
    {
        return [
            'item_id.required' => 'Please select an item form stocking!',
            'quantity.required' => 'You have to specify the stock quantity!',
            'quantity.numeric' => 'Sorry! The stock quantity must be a number!',
            'receiver.required' => 'You must tell us the receiver of the item!',
        ];
    }
}
