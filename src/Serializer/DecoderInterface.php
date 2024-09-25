<?php

declare(strict_types=1);

namespace MwuSdk\Serializer;

/**
 * Defines the contract for decoding data from a string format into an array.
 *
 * Implementing classes should provide a mechanism suitable for the data format they handle.
 */
interface DecoderInterface
{
    /**
     * Decodes the provided data string into an associative array.
     *
     * @param string $data the data string to decode
     *
     * @return array<array-key, mixed> the decoded data as an associative array
     */
    public function decode(string $data): array;
}
