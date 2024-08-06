<?php

declare(strict_types=1);

namespace MwuSdk\Serializer;

interface DecoderInterface
{
    /** @return array<array-key, mixed> */
    public function decode(string $data): array;
}
