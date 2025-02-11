<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ark extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class);
    }

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
        $result = [];

        foreach ($attributes as $attr => $value) {
            $result[] = $value === $current->$attr;
        }

        $result = in_array(false, $result, 1) ? true : false;

        return $result;

    }
}
