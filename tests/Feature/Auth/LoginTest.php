<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\Tools\Http\Enums\Status;
use Laravel\Sanctum\PersonalAccessToken;
use function Pest\Laravel\postJson;

test('it will validate a login request', function (): void {
    postJson(
        uri: action(LoginController::class),
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'email',
    )->assertJsonValidationErrorFor(
        key: 'password',
    );
});

test('it will ensure the credentials are correct', function (): void {
    $user = User::factory()->create();

    postJson(
        uri: action(LoginController::class),
        data: [
            'email' => $user->email,
            'password' => 'wrong-password',
        ],
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'email',
    );
});

test('it will authenticate a user and return an api token', function (): void {
    $user = User::factory()->create();

    expect(
        PersonalAccessToken::query()->count(),
    )->toEqual(0);

    postJson(
        uri: action(LoginController::class),
        data: [
            'email' => $user->email,
            'password' => 'password',
        ],
    )->assertStatus(
        status: Status::OK->value,
    )->assertJson(fn (AssertableJson $json) => $json
        ->has('token')
        ->etc(),
    );

    expect(
        PersonalAccessToken::query()->count(),
    )->toEqual(1);
});
