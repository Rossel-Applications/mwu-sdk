<?php

declare(strict_types=1);

namespace MwuSdk\Serializer;

interface DenormalizerInterface
{
    /** @param array<array-key, mixed> $data */
    public function denormalize(array $data): mixed;
}
