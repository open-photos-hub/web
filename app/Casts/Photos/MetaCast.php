<?php

declare(strict_types=1);

namespace App\Casts\Photos;

use App\DataObjects\Photos\Meta;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

final class MetaCast implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param array{
     *     height:int,
     *     width:int,
     * } $value
     * @param array $attributes
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return Meta::fromArray(
            data: json_decode(
                json: $value,
                associative: true,
            ),
        );
    }

    /**
     * @param Model $model
     * @param string $key
     * @param Meta $value
     * @param array $attributes
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return json_encode(
            value: $value->toArray(),
        );
    }
}
