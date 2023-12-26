<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\Auth\LoginPayload;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Laravel\Sanctum\NewAccessToken;

final readonly class IdentityService
{
    public function __construct(
        private AuthManager $auth,
        private DatabaseManager $database,
    ) {}

    public function authenticate(LoginPayload $payload): bool
    {
        return $this->auth->attempt(
            credentials: $payload->toArray(),
        );
    }

    public function createToken(string $name): NewAccessToken
    {
        return $this->database->transaction(
            callback: fn () => $this->auth->user()?->createToken($name),
        );
    }
}
