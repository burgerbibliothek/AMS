<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Naan as NaanModel;

class ExistingNaan implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $naans = NaanModel::all('naan')->pluck('naan');
        
        if(!in_array($value, $naans->all())){
            $fail('The :attribute is not a valid NAAN.');
        }
    }
}
