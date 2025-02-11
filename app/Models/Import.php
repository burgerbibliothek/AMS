<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Import extends Model
{
    use HasFactory;

    public function failedImportRows(): HasMany
    {
        return $this->hasMany(FailedImportRow::class);
    }

    public function successfullImportRows(): HasManyThrough
    {
        return $this->HasManyThrough(
            Ark::class,
            SuccessfullImportRow::class,
            'import_id',
            'id',
            'id',
            'ark_id'
        );
    }
}
