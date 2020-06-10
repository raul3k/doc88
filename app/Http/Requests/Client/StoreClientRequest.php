<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients',
            'telephone' => 'required',
            'birthdate' => 'required|date_format:Y-m-d',
            'address' => 'required',
            'complement' => 'max:255',
            'neighborhood' => 'required|max:255',
            'zipcode' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name cannot be longer than 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email already registered',
            'telephone.required' => 'Telephone is required',
            'birthdate.required' => 'Birthdate is required',
            'birthdate.date_format' => 'Birthdate must be on this format: Y-m-d',
            'address.required' => 'Address is required',
            'complement.max' => 'Complement cannot be longer than 255 characters',
            'neighborhood.required' => 'Neighborhood is required',
            'neighborhood.max' => 'Neighborhood cannot be longer than 255 characters',
            'zipcode.required' => 'Zip code is required',
        ];
    }
}
