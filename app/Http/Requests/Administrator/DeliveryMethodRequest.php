<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryMethodRequest extends FormRequest
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
        $checks = [
            'name' => 'required|string',
            'cost' => 'required|numeric'
        ];

        if($this->isMethod('patch')) {
            $checks['cost'] = 'numeric';
            $checks['name'] = 'string';
        }
        return $checks;
    }
}
