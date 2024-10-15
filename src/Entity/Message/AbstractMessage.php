<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Message;

use MwuSdk\Entity\Command\CommandInterface;

abstract readonly class AbstractMessage implements MessageInterface
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
     */
    private string $sequenceNumber;

    /**
     * @var CommandInterface the Command to encapsulate in the Message
     */
    private CommandInterface $command;

    public function __construct(
        CommandInterface $command,
        string $sequenceNumber,
    ) {
        $this->command = $command;
        $this->sequenceNumber = $sequenceNumber;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    /**
     * {@inheritDoc}
     */
    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}
