<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueShoulder implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $columnShoulder = array_column($this->data['data']['shoulders'], 'shoulder');
        $shoulders = array_filter($columnShoulder, fn ($value) => ! is_null($value));
        $valueCount = array_count_values($shoulders);
        if ($valueCount[$value] > 1) {
            $fail(':attribute must be unique.');
        }

    }
}
