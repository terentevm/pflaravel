<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingsRequest extends FormRequest
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
            'currency_id' => 'uuid',
            'wallet_id' => 'uuid|nullable',
            'report_currency' => 'uuid|nullable',
            'periodicity' => [
                'required',
                Rule::in(['year', 'quarter', 'month', 'week', 'day']),
            ]
        ];
    }
}
