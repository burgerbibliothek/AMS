<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ArkRevision implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $json = json_decode($value, true);
        $value = '<li><strong>URI:</strong> '.$json['uri'].'</li>';
        if($json['metadata']){
            $value .= '<li><strong>Metadata:</strong> <pre>'.$json['metadata'].'</pre></li>';
        }

        return '<ul>'.$value.'<ul>';
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
