<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNewClient extends FormRequest
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
            'name' => ['required', 'max:64'],
            'businessName' => ['max:64'],
            'cuit' => ['max:12'],
            'balance' => ['nullable'],
            'clientType_id' => ['required'],
            'location_id' => ['required'],
            'location_id.address' => ['required', 'max:64'],
            'location_id.zipCode' => ['required'],
            'location_id.city' => ['required'],
            'location_id.province' => ['required'],
            'location_id.country' => ['nullable'],
            'active' => ['nullable']
        ];
    }
}
