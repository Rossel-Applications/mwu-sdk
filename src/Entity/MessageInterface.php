<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

/**
 * Interface for a Message that encapsulates a Command.
 */
interface MessageInterface
{
    /**
     * Converts the Message to a string representation.
     *
     * @return string the string representation of the Message
     */
    public function __toString(): string;

    /**
     * Gets the Command encapsulated by the Message.
     *
     * @return Command the Command instance
     */
    public function getCommand(): Command;

    /**
     * Gets the sequence number of the Message.
     *
     * @return numeric-string{3} The 3-digit sequence number
     */
    public function getSequenceNumber(): string;
}
