<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command;

/**
 * Interface representing a command that can be converted to a string and whose length can be determined.
 */
interface CommandInterface
{
    /**
     * Get the length of the command.
     *
     * @return int the length of the command
     */
    public function length(): int;

    /**
     * Convert the command to its string representation.
     *
     * @return string the command as a string
     */
    public function __toString(): string;
}
