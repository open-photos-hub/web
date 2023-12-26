<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\Photos\MetaCast;
use App\DataObjects\Photos\Meta;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $path
 * @property string $original_name
 * @property string $mime
 * @property int $size
 * @property null|string $hash
 * @property Meta $meta
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $user
 */
final class Photo extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'path',
        'original_name',
        'mime',
        'size',
        'hash',
        'meta',
        'user_id',
    ];

    protected $casts = [
        'size' => 'integer',
        'meta' => MetaCast::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
