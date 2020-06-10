<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'client' => 'required|exists:clients,id',
            'pastel' => 'required|exists:pastels,id',
        ];
    }

    public function messages()
    {
        return [
            'client.required' => 'Client is required',
            'client.exists' => 'Client must be registered',
            'pastel.required' => 'Pastel is required',
            'pastel.exists' => 'Pastel must be registered',
        ];
    }
}
