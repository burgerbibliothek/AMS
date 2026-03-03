<?php

namespace App\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Closure;
use App\Models\Naan as NaanModel;
use Burgerbibliothek\ArkManagementTools\Ark;
use Illuminate\Contracts\Validation\ValidationRule;

class NaanInDatabase implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=):PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $components = Ark::splitIntoComponents($value);

        if (!NaanModel::firstWhere('naan', '=', $components['naan'])) {
            $fail('NAAN not found in database.');
        }

    }
}
