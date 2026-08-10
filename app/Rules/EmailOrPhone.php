<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailOrPhone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        $isPhone = preg_match('/^(09|\+639)\d{9}$/', $value) === 1;

        if (!$isEmail && !$isPhone) {
            $fail('The :attribute must be a valid email address or PH mobile number.');
        }
    }
}
