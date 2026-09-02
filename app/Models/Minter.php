<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Minter extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    public function naans(): HasMany
    {
        return $this->hasMany(Naan::class, 'minter_id');
    }

    protected static function booted(): void
    {
        static::deleting(function (Minter $minter) {
            $minter->naans()->update(['minter_id' => null]);
        });
    }
}
