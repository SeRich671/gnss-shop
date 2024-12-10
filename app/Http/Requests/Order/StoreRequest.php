<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address.country' => ['required', 'string'],
            'address.city' => ['required', 'string'],
            'address.postcode' => ['required', 'string'],
            'address.street' => ['required', 'string'],
            'address.building' => ['required', 'string'],
            'address.flat' => ['required', 'string'],
        ];
    }
}
