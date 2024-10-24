<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Message;

abstract readonly class AbstractMessage implements MessageInterface
{
    /**
     * Start of text marker (STX).
     *
     * @var string
     */
    public const STX = '';

    /**
     * End of text marker (ETX).
     */
    public const ETX = '';

    /**
     * Sequence number of the message, always a 3-digit numeric string.
     */
    private string $sequenceNumber;

    public function __construct(
        string $sequenceNumber,
    ) {
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
}
