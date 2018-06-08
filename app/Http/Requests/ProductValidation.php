<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class ProductValidation
{
    /**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255',
            'price' => 'required',
            'description' => 'required'
        ];
    }
}