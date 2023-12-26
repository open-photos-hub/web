<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('path');
            $table->string('original_name');
            $table->string('mime');

            $table->unsignedBigInteger('size')->default(0); // size in bytes

            $table->text('hash')->nullable(); // filehash

            $table->json('meta')->nullable();

            $table
                ->foreignUlid('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
