<?php

namespace App\Rules;

use Closure;
use App\Models\Naan as NaanModel;
use Burgerbibliothek\ArkManagementTools\Ark;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidArk implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $components = Ark::splitIntoComponents($value);

        if (!NaanModel::firstWhere('naan', '=', $components['naan'])) {
            $fail('NAAN not found in database.');
        }

    }
}
