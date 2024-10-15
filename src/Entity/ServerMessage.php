<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

use MwuSdk\Entity\Command\CommandInterface;
use Random\RandomException;

/**
 * Representation of a message sent by the sever to the client.
 * This class wraps string data and appends metadata like sequence number, which identifies the message.
 */
final readonly class ServerMessage implements ServerMessageInterface
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
     * Creates a new ServerMessage instance encapsulating the provided data.
     *
     * @param string $data the data to encapsulate in the Server Message
     * @param string $sequenceNumber sequence number of the message, always a 3-digit numeric string.
     */
    public function __construct(
        private string $data,
        private string $sequenceNumber,
    )
    {
    }

    /**
     * Converts the Server Message to its string representation.
     *
     * The format is: STX + sequence number + command length + command + ETX.
     *
     * @return string the string representation of the Server Message
     */
    public function __toString(): string
    {
        $sequenceNumber = $this->getSequenceNumber();
        $data = $this->getData();
        $dataLength = strlen($data);

        return sprintf(
            '%s%03s%04s%s%s',
            self::STX,
            $sequenceNumber,
            $dataLength,
            $data,
            self::ETX,
        );
    }

    /**
     * @inheritDoc
     */
    public function getData(): string
    {
        return $this->data;
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
}
