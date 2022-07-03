<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' =>['required','max:25'],
            'description' =>['required', 'max:255'],
            'place_id' =>['required','exists:places,id'],
            'image'=>[
                'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png', 
            ],
            'image2'=>[
                'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png', 
            ],


            
        ];
    }
}
