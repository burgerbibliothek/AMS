<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidNaan implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=):PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
