<?php

namespace App\Models;

use App\Casts\ArkRevision as ArkRevisionCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class ArkRevision extends Model
{
    protected function casts(): array
    {
        return [
            'revision' => ArkRevisionCast::class,
        ];
    }

    public function ark(): BelongsTo
    {
        return $this->belongsTo(Ark::class, 'ark_id', 'id');
    }

    /**
     * Decoded revision payload (the cast only returns a HTML representation).
     *
     * @return array{uri?: string, 'http-status'?: ?string, metadata?: ?string}
     */
    public function payload(): array
    {
        return json_decode($this->getRawOriginal('revision'), true) ?? [];
    }

    /**
     * Store the state of an ARK as a new revision.
     */
    public static function snapshot(Ark $ark): self
    {
        $statusId = $ark->getOriginal('status_id');
        $status = $statusId ? Status::find($statusId)?->label : null;

        $revision = new self;
        $revision->ark_id = $ark->id;
        $revision->revision = json_encode([
            'uri' => $ark->getOriginal('uri'),
            'http-status' => $status,
            'metadata' => $ark->getOriginal('metadata'),
        ]);
        $revision->save();

        return $revision;
    }

    /**
     * Restore the ARK to the state stored in this revision.
     *
     * The current state is saved as a new revision first, so a restore can be
     * undone. The ARK identifier itself is never changed. Revisions created by
     * the CSV import carry no HTTP status; in that case (or if the stored
     * status no longer exists) the current status is kept.
     *
     * @return bool false if there was nothing to restore or nothing would change
     */
    public function restore(): bool
    {
        $data = $this->payload();
        $ark = $this->ark;

        if ($ark === null || array_key_exists('uri', $data) === false) {
            return false;
        }

        $attributes = [
            'uri' => $data['uri'],
            'metadata' => $data['metadata'] ?? null,
        ];

        if (array_key_exists('http-status', $data)) {
            if ($data['http-status'] === null) {
                $attributes['status_id'] = null;
            } elseif ($status = Status::firstWhere('label', $data['http-status'])) {
                $attributes['status_id'] = $status->id;
            }
        }

        $ark->fill($attributes);


        if ($ark->isDirty() === false) {
            return false;
        }

        DB::transaction(function () use ($ark) {
            self::snapshot($ark);
            $ark->save();
        });

        return true;
    }
}
