<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ark extends Model
{
    protected $table = 'arks';
    protected $guarded = ['id','created_at'];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }
    
}
