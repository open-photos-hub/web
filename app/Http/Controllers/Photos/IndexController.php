<?php

declare(strict_types=1);

namespace App\Http\Controllers\Photos;

use App\Http\Resources\PhotoResource;
use App\Http\Responses\CollectionResponse;
use App\Services\CollectionService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final readonly class IndexController
{
    public function __construct(
        private CollectionService $service,
    ) {}

    public function __invoke(Request $request): Responsable
    {
        return new CollectionResponse(
            data: PhotoResource::collection(
                resource: $this->service->list()->paginate(),
            ),
            links: [
                'self' => route('photos:index'),
            ],
            key: 'photos',
        );
    }
}
