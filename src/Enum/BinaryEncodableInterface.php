<?php

declare(strict_types=1);

namespace MwuSdk\Enum;

/**
 * Interface implemented by enums that can be converted into binary values.
 *
 * This interface requires implementing classes to provide a method for
 * obtaining a binary representation of the enum instance.
 * Enums that implement this interface can be used in contexts where
 * binary encoding is required, such as communication protocols or
 * low-level hardware interactions.
 */
interface BinaryEncodableInterface
{
    /**
     * Returns the binary representation of the enum instance.
     *
     * This method should return an integer value that corresponds
     * to the binary encoding of the enum case. The exact representation
     * will depend on the specific enum implementation.
     *
     * @return int the binary value representing the enum instance
     */
    public function getBinaryValue(): int;
}
