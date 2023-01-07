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
        return [
            'title' => 'required|max:150|string',
            'attire_image' => 'max:2048|mimes:png,jpg',
            'group' => 'string|required'
        ];
        
        // if ($this->isMethod('patch')) {
        //     // $check['attire_image'] = ['image'];
        // }
        // return $check;
    }
}
