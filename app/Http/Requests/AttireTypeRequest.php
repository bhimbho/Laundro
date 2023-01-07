<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttireTypeRequest extends FormRequest
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
        $check = [
            'title' => 'required|max:100|string',
            'attire_image' => 'required|image',
            'group' => 'required|string'
        ];
        
        if ($this->isMethod('patch')) {
            $check['attire_image'] = ['image'];
        }
        return $check;
    }
}
