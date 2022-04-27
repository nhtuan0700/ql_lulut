<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu mới',
            'password_confirmation' => 'xác nhận mật khẩu',
        ];
    }
}
