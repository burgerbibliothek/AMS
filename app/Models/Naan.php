<?php

namespace App\Models;

use App\Models\Minter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Naan extends Model
{
    protected $table = 'naans';

    protected function casts(): array
    {
        return [
            'shoulders' => 'array',
        ];
    }

    public function minter(): HasOne
    {
        return $this->hasOne(Minter::class, 'id');
    }
}
