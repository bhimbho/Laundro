<?php

namespace App\Http\Requests\Administrator;

use App\Http\Enum\RoleEnum;
use App\Rules\CheckExistMoreThanOnce;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateAdminRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:administrators',
            'email' => 'required|string|email|max:255|unique:administrators',
            'role' => [new Enum(RoleEnum::class)],
            'password' => 'required|string|min:8|confirmed',
        ];

        if ($this->isMethod('patch')) {
            $checks['password'] = ['nullable|string|min:8'];
            $checks['username'] = ['required', 'max:255', new CheckExistMoreThanOnce];
            $checks['email'] = ['required','string','email','max:255', new CheckExistMoreThanOnce];
        }
        
        return $checks;
    }
}
