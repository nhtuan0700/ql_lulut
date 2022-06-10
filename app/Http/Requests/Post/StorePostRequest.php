<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'images' => 'max:5',
            'images.*' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'images.max' => 'Trường này chỉ được tối đa 5 hình'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'tiêu đề',
            'content' => 'nội dung',
            'images' => 'hình ảnh'
        ];
    }
}
