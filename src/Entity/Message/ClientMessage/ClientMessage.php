<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Message\ClientMessage;

use Random\RandomException;
use Rossel\MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;
use Rossel\MwuSdk\Entity\Message\AbstractMessage;

/**
 * Encapsulates a Command into a Message to be transmitted to the MWU switch.
 *
 * This class wraps a Command object and appends metadata like sequence number,
 * start of text (STX), and end of text (ETX) to create a complete message for transmission.
 */
final readonly class ClientMessage extends AbstractMessage implements ClientMessageInterface
{
    /**
     * Creates a new Message instance encapsulating the provided Command.
     *
     * @throws RandomException if the sequence number initialization fails
     */
    public function __construct(
        private ClientCommandInterface $command,
        ?string $sequenceNumber = null
    ) {
        $sequenceNumber = $sequenceNumber ?? $this->generateSequenceNumber();
        parent::__construct($sequenceNumber);
    }

    /**
     * Generates a random 3-digit numeric sequence number.
     *
     * @throws RandomException if random number generation fails
     *
     * @return string A randomly generated 3-digit numeric sequence number
     */
    private function generateSequenceNumber(): string
    {
        $nonFormattedSequenceNumber = (string) random_int(0, 999);

        return str_pad($nonFormattedSequenceNumber, 3, '0', \STR_PAD_LEFT);
    }

    /**
     * {@inheritDoc}
     */
    public function getCommand(): ClientCommandInterface
    {
        return $this->command;
    }
}
