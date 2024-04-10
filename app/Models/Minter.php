<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minter extends Model
{
    protected $table = 'minter_settings';
    use HasFactory;
}
