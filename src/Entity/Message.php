<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

use MwuSdk\Entity\Command\CommandInterface;
use Random\RandomException;

/**
 * Encapsulates a Command into a Message to be transmitted to the MWU Light Module.
 *
 * This class wraps a Command object and appends metadata like sequence number,
 * start of text (STX), and end of text (ETX) to create a complete message for transmission.
 */
final readonly class Message implements MessageInterface
{
    /**
     * Start of text marker (STX).
     *
     * @var string{1}
     */
    public const STX = '';

    /**
     * End of text marker (ETX).
     *
     * @var string{1}
     */
    public const ETX = '';

    /**
     * Sequence number of the message, always a 3-digit numeric string.
     *
     * @var string{3}
     */
    private string $sequenceNumber;

    /**
     * Creates a new Message instance encapsulating the provided Command.
     *
     * @param CommandInterface $command the Command to encapsulate in the Message
     *
     * @throws RandomException if the sequence number initialization fails
     */
    public function __construct(private CommandInterface $command)
    {
        $this->sequenceNumber = $this->generateSequenceNumber();
    }

    /**
     * Converts the Message to its string representation.
     *
     * The format is: STX + sequence number + command length + command + ETX.
     *
     * @return string the string representation of the Message
     */
    public function __toString(): string
    {
        $sequenceNumber = $this->getSequenceNumber();
        $command = $this->getCommand();
        $commandLength = $command->length();

        return sprintf(
            '%s%03s%04s%s%s',
            self::STX,
            $sequenceNumber,
            $commandLength,
            $command,
            self::ETX,
        );
    }

    /**
     * Retrieves the encapsulated Command.
     *
     * @return CommandInterface the Command instance
     */
    public function getCommand(): CommandInterface
    {
        return $this->command;
    }

    /**
     * Retrieves the sequence number of the Message.
     *
     * @return string{3} The 3-digit numeric sequence number
     */
    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    /**
     * Generates a random 3-digit numeric sequence number.
     *
     * @throws RandomException if random number generation fails
     *
     * @return string{3} A randomly generated 3-digit numeric sequence number
     */
    private function generateSequenceNumber(): string
    {
        $nonFormattedSequenceNumber = (string) random_int(0, 999);

        return str_pad($nonFormattedSequenceNumber, 3, '0', \STR_PAD_LEFT);
    }
}
