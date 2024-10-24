<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer;

/**
 * Base class for deserializers, providing common functionality for decoding
 * and denormalizing data into specific object types.
 *
 * @template T of object The type of object that this deserializer will create.
 */
abstract readonly class AbstractDeserializer implements DeserializerInterface
{
    /**
     * Deserializes a data string into an object of type T.
     *
     * This method decodes the input string and then denormalizes the decoded data
     * into an object of type T.
     *
     * @param string $data the data string to deserialize
     *
     * @return T the deserialized object
     */
    /** @return T */
    public function deserialize(string $data): mixed
    {
        $decoded = $this->decode($data);

        return $this->denormalize($decoded);
    }

    /**
     * Denormalizes the given data into an object of type T.
     *
     * This method must be implemented by subclasses to define how to convert
     * the decoded data into a specific object type.
     *
     * @param array<array-key, mixed> $data the data to denormalize
     *
     * @return T the denormalized object
     */
    /** @return T */
    abstract public function denormalize(array $data): mixed;

    /**
     * Decodes the input data.
     *
     * This method should be implemented by subclasses to provide
     * the decoding functionality for the specific data format.
     *
     * @param string $data the data string to decode
     *
     * @return array<array-key, mixed> the decoded data
     */
    abstract public function decode(string $data): array;
}
