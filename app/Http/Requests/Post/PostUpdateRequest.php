<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'post_title' => 'required|string',
            'post_content' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'post_title.required' => 'Please Enter Post Title',
            
            'post_content' => 'Please Enter Post Contents',

        ];
    }
}
