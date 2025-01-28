<?php

namespace App\Models;

use App\Casts\ArkRevision as ArkRevisionCast;
use Illuminate\Database\Eloquent\Model;

class ArkRevision extends Model
{
    protected function casts(): array
    {
        return [
            'revision' => ArkRevisionCast::class,
        ];
    }
}
