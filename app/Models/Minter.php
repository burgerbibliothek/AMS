<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Minter extends Model
{
    protected $table = 'minter_settings';
    use HasFactory;

    public function naans(): HasMany
    {
        return $this->hasMany(Naan::class, 'minter_settings_id');
    }
    
    protected static function booted(): void
    {
        static::deleting(function(Minter $minter) {
            $minter->naans()->update(['minter_settings_id' => null]);
       });
    }
    

}
