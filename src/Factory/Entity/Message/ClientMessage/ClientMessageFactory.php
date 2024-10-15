<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Message\ClientMessage;

use MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;
use MwuSdk\Entity\Message\ClientMessage\ClientMessage;
use Random\RandomException;

/**
 * Factory class for creating Message instances, encapsulating Command objects.
 */
final class ClientMessageFactory implements ClientMessageFactoryInterface
{
    /**
     * @throws RandomException
     */
    public function create(
        ClientCommandInterface $command,
        ?string $sequenceNumber = null,
    ): ClientMessage {
        return new ClientMessage($command, $sequenceNumber);
    }
}
