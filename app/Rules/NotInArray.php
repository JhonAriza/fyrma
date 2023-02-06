<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotInArray implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $array = [];
    private $varName;

    public function __construct($array, $name)
    {
        $this->array = $array;
        $this->varName = $name;
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
        if (in_array($value, $this->array)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La ' . $this->varName . ' ya existe.';
    }
}
