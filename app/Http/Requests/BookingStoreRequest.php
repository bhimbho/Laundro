<?php

namespace App\Http\Requests;

use App\Http\Enum\PaymentEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingStoreRequest extends FormRequest
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
            'bookings.*.attire_type_id' => 'required|uuid|exists:attire_types,id',
            'bookings.*.service_id' => 'required|uuid|exists:services,id',
            'bookings.*.quantity' => 'required|integer',
            'bookings.*.service_hours' => 'required|in:6,12,24,48',
            'bookings.*.service_method_id' => 'uuid|exists:service_methods,id|nullable',
            'customer_id' => 'uuid|required_without:customer_name|exists:customers,id',
            'customer_name' => 'required_without:customer_id|string',
            'customer_phone' => 'string|required_without:customer_id|required_with:customer_name',
            'customer_email' => 'sometimes|email',
            'address' => 'sometimes|string',
            'payment_type' => Rule::in(['debit', 'cheque', 'transfer', 'credit', 'cash']),
            'delivery_method_id' => 'required|exists:delivery_methods,id',
        ];
    }

    public function attributes() {
        return [
            'bookings.*.attire_type_id' => 'attire type',
            'bookings.*.service_id' => 'service',
            'bookings.*.service_method_id' => 'service method',
            'bookings.*.quantity' => 'quantity',
            'bookings.*.status' => 'status',
            'bookings.*.expected_collection_date' => 'expected delivery',
            'bookings.*.attire_type_id' => 'attire type',
        ];
    }

    // public function messages()
    // {
       
    // }
}
