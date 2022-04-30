<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|regex:/[0-9]{10}/'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'họ tên',
            'password' => 'mật khẩu',
            'phone_number' => 'số điện thoại'
        ];
    }
}
