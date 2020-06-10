<?php

namespace App\Http\Requests\Pastel;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePastelRequest extends FormRequest
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
            'name' => 'max:255',
            'price' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Name cannot be longer than 255 characters',
            'price.numeric' => 'Price must be numeric',
        ];
    }
}
