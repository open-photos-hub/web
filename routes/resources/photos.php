<?php

declare(strict_types=1);

use App\Http\Controllers\Photos;
use Illuminate\Support\Facades\Route;

Route::get('/', Photos\IndexController::class)->name('index');
