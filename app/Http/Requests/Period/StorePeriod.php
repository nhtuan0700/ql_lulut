<?php

namespace App\Http\Requests\Period;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriod extends FormRequest
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
            'name' => 'required|min:10',
            'date_end' => 'required',
            'ward_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên',
            'date_end' => 'ngày kết thúc'
        ];
    }
}
