<?php

namespace App\Http\Requests\Pastel;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'photo.image' => 'Photo must be an image',
            'photo.mimes' => 'Photo must be jpg, jpeg or png',
            'photo.max' => 'Photo cannot be bigger than 2mb',
        ];
    }
}
