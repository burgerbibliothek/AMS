<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Naan extends Model
{
    protected $guarded = ['id', 'created_at'];

    protected function casts(): array
    {
        return [
            'shoulders' => 'array',
        ];
    }

    public function minter(): HasOne
    {
        return $this->hasOne(Minter::class, 'id', 'minter_id');
    }


    public static function nmas(): Collection
    {
        return self::whereNotNull('nma')->distinct()->get('nma');
    }

    /**
     * Retrieve Shoulders for a NAAN.
     *
     * @param  $naan  string
     * @return array
     */
    public static function shoulders($naan): array
    {
        $options = [];
        $shoulders = self::where('naan', $naan)->first()->shoulders;
        foreach ($shoulders as $shoulder) {
            $options[$shoulder['shoulder']] = "{$shoulder['shoulder']} ({$shoulder['description']})";
        }

        return $options;
    }

    public static function hasShoulder($naan): bool
    {
        return self::where('naan', '=', $naan)->whereNotNull('shoulders')->exists();
    }

    public static function suffixPasstrough($naan): bool
    {
        return self::select('spt')->where('naan', '=', $naan)->first()->spt;
    }
}
