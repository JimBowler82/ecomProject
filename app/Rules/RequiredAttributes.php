<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RequiredAttributes implements Rule
{
    private $requiredAttributes;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($requiredAttributes)
    {
        $this->requiredAttributes = $requiredAttributes;
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
        $productAttributes = json_decode($value, true);
        
        foreach ($this->requiredAttributes as $required) {
            if (!in_array($required, array_keys($productAttributes))) {
                return false;
            }
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
        return "Product attributes must contain " . ucwords(implode(', ', $this->requiredAttributes));
    }
}
