<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Message\ClientMessage;

use Random\RandomException;
use Rossel\MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;
use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessage;

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
