<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Photo;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class CollectionService
{
    public function __construct(
        private AuthManager $auth,
    ) {}

    public function list(
        array $includes = [],
        array $filters = [],
        array $sorts = [],
    ): Builder {
        return QueryBuilder::for(
            subject: Photo::query(),
        )->allowedIncludes(
            includes: $includes,
        )->allowedFilters(
            filters: $filters,
        )->allowedSorts(
            sorts: $sorts,
        )->where(
            'user_id',
            $this->auth->id(),
        )->getEloquentBuilder();
    }
}
