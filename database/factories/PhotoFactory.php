<?php

declare(strict_types=1);

namespace Database\Factories;

use App\DataObjects\Photos\Meta;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

final class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    /**
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'path' => $this->faker->filePath(),
            'original_name' => $this->faker->word(),
            'mime' => $this->faker->mimeType(),
            'size' => $this->faker->randomDigitNotNull(),
            'hash' => Str::random(),
            'meta' => new Meta(
                height: $this->faker->randomDigitNotNull(),
                width: $this->faker->randomDigitNotNull(),
            ),
            'user_id' => User::factory(),
        ];
    }
}
