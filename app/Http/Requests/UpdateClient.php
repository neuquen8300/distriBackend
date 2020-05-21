<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClient extends FormRequest
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
            'name' => ['max:64'],
            'businessName' => ['max:64'],
            'cuit' => ['max:12'],
            'clientType_id' => ['required'],
            'location_id' => ['nullable'],
            'active' => ['required']
        ];
    }
}
