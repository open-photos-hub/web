<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Photo $resource
 */
final class PhotoResource extends JsonResource
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'file' => [
                'path' => $this->resource->path,
                'name' => $this->resource->original_name,
                'mime' => $this->resource->mime,
                'hash' => $this->resource->hash,
                'size' => $this->resource->size,
            ],
            'meta' => $this->resource->meta->toArray(),
            'created' => new DateResource(
                resource: $this->resource->created_at,
            ),
        ];
    }
}
