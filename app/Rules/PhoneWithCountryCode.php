<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;

class PhoneWithCountryCode implements Rule
{
    public function passes($attribute, $value)
    {
        // Validate the phone number with country code logic here
        // You can use regular expressions or any other validation method

        // Example: Validate if the phone number starts with "+880" (Bangladesh country code)
        return strpos($value, '+880') === 0;
    }

    public function message()
    {
        return 'The phone number must have the Bangladesh country code (+880).';
    }
}
