<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class customCreateStockRequest extends FormRequest
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
            'from' => 'required',
            'item_id' => 'required',
            'quantity' => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'from.required' => 'Please tell us where the item is coming from!',
            'item_id.required' => 'Please select an item form stocking!',
            'quantity.required' => 'You have to specify the stock quantity!',
            'quantity.numeric' => 'Sorry! The stock quantity must be a number!',
        ];
    }
}
