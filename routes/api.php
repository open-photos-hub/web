<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('auth:')->group(
    base_path('routes/resources/auth.php'),
);

Route::middleware(['auth:sanctum','verified'])->group(static function (): void {
    Route::prefix('photos')->as('photos:')->group(
        base_path('routes/resources/photos.php'),
    );
});
