<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    protected $table = 'status';

    public function ark(): BelongsTo
    {
        return $this->belongsTo(Ark::class);
    }

}
