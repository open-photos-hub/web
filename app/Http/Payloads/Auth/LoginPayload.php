<?php

declare(strict_types=1);

namespace App\Http\Payloads\Auth;

final readonly class LoginPayload
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
