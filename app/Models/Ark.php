<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ark extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at'];

    public function ark_revisions(): HasMany
    {
        return $this->hasMany(ArkRevision::class, 'ark_id', 'id');
    }

    public function successfullImportRows(): BelongsToMany
    {
        return $this->BelongsToMany(SuccessfullImportRow::class);
    }

    public static function hasChanged(int $id, array $attributes): bool
    {
        $current = self::find($id);

        /** return true if current and update fields are the same value */
        if($attributes['ark'] === $current->ark && $attributes['uri'] === $current->uri && $attributes['status_id'] === $current->status_id && $attributes['metadata'] === $current->metadata){
            return false;
        }
        
        return true;

    }
}
