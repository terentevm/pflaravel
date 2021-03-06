<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserSignup extends FormRequest
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
            'name' => 'required',
            'login' => 'required|email|unique:users,login',
            'password' => 'required',
            'currency' => [
                'sometimes',
                'required',
                Rule::in(['RUB', 'CZK', 'EUR']),
            ]
        ];
    }


}
