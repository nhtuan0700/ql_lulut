<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfo extends FormRequest
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
        return  [
            'name' => 'required|string',
            'phone_number' => 'required|regex:/[0-9]{10}/',
            'dob' => 'required|date_format:d/m/Y',
            'card_id' => 'required|string|min:9|max:12',
        ];
    }

    public function attributes()
    {
        return [
            'phone_number' => 'số điện thoại',
            'address' => 'địa chỉ',
            'card_id' => 'chứng minh nhân dân',
            'dob' => 'ngày sinh',
        ];
    }
}
