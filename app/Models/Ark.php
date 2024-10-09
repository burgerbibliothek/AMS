<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ark extends Model
{
    protected $table = 'arks';
    protected $guarded = ['id','created_at'];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }

    public function ark_revisions(): HasMany
    {
        return $this->hasMany(ArkRevision::class, 'ark_id', 'id');
    }
    
}
