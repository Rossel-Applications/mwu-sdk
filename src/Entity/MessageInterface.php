<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

/**
 * Generic interface for a Message transmitted between client and server.
 *
 * This interface defines methods for retrieving the sequence number,
 * as well as converting the message to a string format.
 */
interface MessageInterface
{
    /**
     * Converts the Message to a string representation.
     *
     * The string includes the start of text (STX), sequence number,
     * data/command length, the actual command, and the end of text (ETX).
     *
     * @return string the string representation of the Message
     */
    public function __toString(): string;

    /**
     * Retrieves the sequence number of the Message.
     *
     * @return numeric-string{3} A 3-digit numeric string representing the sequence number
     */
    public function getSequenceNumber(): string;
}
