<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imports extends Model
{
    protected $table = 'imports';    
    use HasFactory;

    public function failedImportRows(): HasMany
    {
        return $this->hasMany(FailedImportRow::class);
    }
}
