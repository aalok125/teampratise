<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'post_title' => 'required|string|unique:posts',
            'post_content' =>'required',
            'name'  =>  'required|file|image|mimes:jpeg,png,gif,jpg|max:4096',
        ];
    }

    public function messages()
    {
        return [
            'post_title.required' => 'Please Enter Post Title',
            'post_title.unique' => 'Post Title Already in use. Please Enter New Title.',
            'post_content.required' => 'Please Enter Post Contents',

        ];
    }
}
