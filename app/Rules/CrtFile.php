<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CrtFile implements Rule
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
        $ex = explode('.', $value->getClientOriginalName());
        
        return end($ex) === 'crt' ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please upload a crt file';
    }
}
