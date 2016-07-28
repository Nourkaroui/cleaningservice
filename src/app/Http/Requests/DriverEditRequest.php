<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DriverEditRequest extends Request{

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
           //'username' => 'required|max:20|min:3|alpha_dash|unique:users',
            'first_name' => 'required|max:20|min:3|alpha_dash',
            'last_name'=> 'required|max:20|min:3|alpha_dash',
            'address'=> 'required|max:150|min:3',
            'city'=> 'required|max:20|min:3',
            'zip'=> 'required|max:20|min:3|alpha_dash',
            //'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6|max:16',
        ];
    }
}