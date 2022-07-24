<?php

namespace App\Rules;

use App\Models\Administrator;
use Illuminate\Contracts\Validation\Rule;

class CheckExistMoreThanOnce implements Rule
{
    protected $value, $attribute;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $adminCount = Administrator::where('username', $value)->count();
        $this->value = $value;
        $this->attribute = $attribute;
        return $adminCount > 1 ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return sprintf('The %s: %s as already been taken.', $this->attribute, $this->value);
    }
}
