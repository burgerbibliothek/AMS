<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SuccessfullImportRow extends Model
{
    protected $table = 'successfull_import_rows';
    public $timestamps = false;

    public function arks(): HasMany
    {
        return $this->hasMany(Ark::class, 'id', 'ark_id');
    }

    public function imports(): BelongsTo
    {
        return $this->BelongsTo(Imports::class, 'id', 'import_id');
    }



}
