<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateClientRequest extends FormRequest
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
        $client_id = Str::of($this->getUri())->afterLast('/');
        return [
            'name' => 'max:255',
            'email' => 'email|unique:clients,email,'.$client_id,
            'telephone' => '',
            'birthdate' => 'date_format:Y-m-d',
            'address' => '',
            'complement' => 'max:255',
            'neighborhood' => 'max:255',
            'zipcode' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Name cannot be longer than 255 characters',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email already registered',
            'birthdate.date_format' => 'Birthdate must be on this format: Y-m-d',
            'complement.max' => 'Complement cannot be longer than 255 characters',
            'neighborhood.max' => 'Neighborhood cannot be longer than 255 characters',
        ];
    }
}
