<?php

declare(strict_types=1);

namespace MwuSdk\Serializer;

/**
 * Defines the contract for deserializing data from a string format.
 *
 * This interface extends DecoderInterface and DenormalizerInterface.
 */
interface DeserializerInterface extends DecoderInterface, DenormalizerInterface
{
    /**
     * Deserializes a string into a structured object or value.
     *
     * @param string $data the string data to deserialize
     *
     * @return mixed the resulting deserialized object or value
     */
    public function deserialize(string $data): mixed;
}
