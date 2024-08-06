<?php

declare(strict_types=1);

namespace MwuSdk\Serializer;

interface DeserializerInterface extends DecoderInterface, DenormalizerInterface
{
    public function deserialize(string $data): mixed;
}
