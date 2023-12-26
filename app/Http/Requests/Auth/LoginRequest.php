<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Payloads\Auth\LoginPayload;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    /**
     * @return array<string,Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @return LoginPayload
     */
    public function toPayload(): LoginPayload
    {
        return new LoginPayload(
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
        );
    }
}
