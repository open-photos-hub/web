<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final readonly class CollectionResponse implements Responsable
{
    public function __construct(
        private AnonymousResourceCollection $data,
        private array $links,
        private string $key,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                $this->key => $this->data,
                '__links' => $this->links,
                'meta' => [
                    'total' => $this->data->collection->count(),
                ],
            ]
        );
    }
}
