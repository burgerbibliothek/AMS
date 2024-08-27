<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ark extends Model
{
    use SoftDeletes;

    protected $table = 'arks';
    protected $guarded = ['id','created_at'];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(ArkRevisions::class);
    }
    
}
