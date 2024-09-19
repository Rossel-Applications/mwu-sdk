<?php

declare(strict_types=1);

namespace MwuSdk\Serializer;

/** @template T of object */
abstract readonly class AbstractDeserializer implements DeserializerInterface
{
    /** @return T */
    public function deserialize(string $data): mixed
    {
        $decoded = $this->decode($data);

        return $this->denormalize($decoded);
    }

    /**
     * @return T
     */
    abstract public function denormalize(array $data): mixed;
}
