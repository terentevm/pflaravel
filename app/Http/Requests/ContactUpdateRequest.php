<?php

namespace App\Http\Requests;

class ContactUpdateRequest extends ContactRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules['id'] = 'required|uuid';

        return $rules;
    }
}
