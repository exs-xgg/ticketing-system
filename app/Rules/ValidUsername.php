<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidUsername implements Rule
{
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
        return preg_match('/^([\w.-](?!\.(com|net|html?|js|jpe?g|png)$)){5,}$/', $value);
        // return ($value) === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The username may only contain letters, numbers, dashes, period and underscores.';
    }
}
