<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductEditRequest extends Request {

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
    public function rules() {
        return [
            'product_name' => 'required|max:75|min:3',
            'category' => 'required',
            'product_qty' => 'required|min:1',
            'product_sku' => 'required|integer',
            'price' => 'required|min:1',
            'reduced_price' => 'min:1',
            'description' => 'required|max:2500|min:10',

        ];
    }

}