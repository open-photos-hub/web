<?php

declare(strict_types=1);

namespace App\DataObjects\Photos;

final readonly class Meta
{
    /**
     * @param int $height
     * @param int $width
     */
    public function __construct(
        public int $height,
        public int $width,
    ) {}

    /**
     * @param array{
     *     height:int,
     *     width:int,
     * } $data
     * @return Meta
     */
    public static function fromArray(array $data): Meta
    {
        return new Meta(
            height: $data['height'],
            width: $data['width'],
        );
    }

    /**
     * @return array{
     *     height:int,
     *     width:int,
     * }
     */
    public function toArray(): array
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
        ];
    }
}
