<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletRequest extends FormRequest
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
            'currency_id' => 'required|uuid',
            'is_creditcard' => 'required|boolean',
            'grace_period' => 'required|numeric|min:0',
            'credit_limit' => 'required|numeric',
        ];
    }
}
