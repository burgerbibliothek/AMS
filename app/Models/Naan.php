<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Naan extends Model
{
    protected $table = 'naans';

    protected function casts(): array
    {
        return [
            'shoulders' => 'array',
        ];
    }
}
