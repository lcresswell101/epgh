<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'date' => 'sometimes|nullable|date|after:today',
            'engineer' => 'sometimes|nullable|string|max:255',
            'first_hour_cost' => 'sometimes|nullable|numeric',
            'name' => 'required|string|max:255',
            'email' => 'sometimes|nullable|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'sometimes|nullable|string|max:255',
            'postcode' => 'sometimes|nullable|string',
            'information' => 'sometimes|nullable|string|max:255',
            'invoice_number' => 'sometimes|nullable|numeric',
            'material_cost' => 'sometimes|nullable|numeric',
            'labour_cost' => 'sometimes|nullable|numeric',
            'paypal_fee' => 'sometimes|nullable|numeric',
            'booking_fee' => 'sometimes|nullable|numeric',
            'vat' => 'sometimes|nullable|numeric',
            'total' => 'sometimes|nullable|numeric'
        ];
    }
}
