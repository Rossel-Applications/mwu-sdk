<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

use Random\RandomException;

/**
 * Message that encapsulates the Command.
 */
final readonly class Message implements MessageInterface
{
    /** @var string{1} */
    public const STX = '';

    /** @var string{1} */
    public const ETX = '';

    /**
     * Sequence number of the message, always a 3-digit numeric string.
     *
     * @var string{3}
     */
    private string $sequenceNumber;

    /**
     * @throws RandomException if the sequence number initialization fails
     */
    public function __construct(private Command $command)
    {
        $this->sequenceNumber = $this->generateSequenceNumber();
    }

    /**
     * {@inheritDoc}
     *
     * @return string the string representation of the Message
     */
    public function __toString(): string
    {
        $sequenceNumber = $this->getSequenceNumber();
        $command = $this->getCommand();
        $commandLength = $command->length();

        return self::STX.$sequenceNumber.$commandLength.$command.self::ETX;
    }

    /**
     * {@inheritDoc}
     *
     * @return Command the Command instance
     */
    public function getCommand(): Command
    {
        return $this->command;
    }

    /**
     * {@inheritDoc}
     *
     * @return string{3} The 3-digit sequence number
     */
    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    /**
     * Generates a random sequence number as a 3-digit numeric string.
     *
     * @throws RandomException if the random number generation fails
     *
     * @return string{3} a random sequence number
     */
    private function generateSequenceNumber(): string
    {
        $nonFormattedSequenceNumber = (string) random_int(0, 999);

        return str_pad($nonFormattedSequenceNumber, 3, '0', \STR_PAD_LEFT);
    }
}
