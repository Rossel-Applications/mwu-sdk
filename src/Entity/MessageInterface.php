<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

use MwuSdk\Entity\Command\CommandInterface;

/**
 * Interface for a Message that encapsulates a Command to be sent to the MWU Light Module.
 *
 * This interface defines methods for retrieving the encapsulated command and
 * sequence number, as well as converting the message to a string format.
 */
interface MessageInterface
{
    /**
     * Converts the Message to a string representation.
     *
     * The string includes the start of text (STX), sequence number,
     * command length, the actual command, and the end of text (ETX).
     *
     * @return string the string representation of the Message
     */
    public function __toString(): string;

    /**
     * Retrieves the encapsulated Command instance.
     *
     * @return CommandInterface the Command instance
     */
    public function getCommand(): CommandInterface;

    /**
     * Retrieves the sequence number of the Message.
     *
     * @return numeric-string{3} A 3-digit numeric string representing the sequence number
     */
    public function getSequenceNumber(): string;
}
