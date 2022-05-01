<?php

namespace App\Http\Requests\Family;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFamily extends FormRequest
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
            'holdhouse_id' => 'required|numeric',
            'owner_name' => 'required',
            'person_qty' => 'required|integer|min:0',
            'address' => 'required',
            'ward_id' => 'required|exists:wards,id'
        ];
    }
}
