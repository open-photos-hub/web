<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\MessageResponse;
use App\Services\IdentityService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $service,
    ) {}

    public function __invoke(LoginRequest $request): Responsable
    {
        if (! $this->service->authenticate($request->toPayload())) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }

        $token = $this->service->createToken(
            name: $request->userAgent(),
        );

        return new MessageResponse(
            key: 'token',
            message: $token->plainTextToken,
        );
    }
}
