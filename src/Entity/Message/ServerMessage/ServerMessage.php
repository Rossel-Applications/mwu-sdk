<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Message\ServerMessage;

use Rossel\MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use Rossel\MwuSdk\Entity\Message\AbstractMessage;

/**
 * Representation of a message sent by the sever to the client.
 * This class wraps string data and appends metadata like sequence number, which identifies the message.
 */
final readonly class ServerMessage extends AbstractMessage implements ServerMessageInterface
{
    /**
     * Creates a new Message instance encapsulating the provided Command.
     */
    public function __construct(
        private ServerCommandInterface $command,
        string $sequenceNumber,
    ) {
        parent::__construct($sequenceNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getCommand(): ServerCommandInterface
    {
        return $this->command;
    }
}
