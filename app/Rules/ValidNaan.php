<?php

namespace App\Rules;

use Closure;
use Burgerbibliothek\ArkManagementTools\Validator;
use Illuminate\Translation\PotentiallyTranslatedString;
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

        if (Validator::isValidNaan($value) === false) {
            $fail('Form of NAAN is not valid.');
        }

    }
}
