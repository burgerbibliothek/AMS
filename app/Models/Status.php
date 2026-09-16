<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Status extends Model
{
    protected $table = 'status';
    protected $guarded = ['id', 'created_at'];
}
