<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer;

/**
 * Defines the contract for denormalizing data from an array format.
 *
 * Implementing classes should convert the provided data into a specific object or value type.
 */
interface DenormalizerInterface
{
    /**
     * Denormalizes the provided data array into a specific object or value type.
     *
     * @param array<array-key, mixed> $data the data to denormalize as an associative array
     *
     * @return mixed the resulting denormalized object or value
     */
    public function denormalize(array $data): mixed;
}
