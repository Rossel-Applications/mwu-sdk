<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity;

use MwuSdk\Entity\Command\CommandInterface;
use MwuSdk\Entity\ClientMessage;
use Random\RandomException;

/**
 * Factory class for creating Message instances, encapsulating Command objects.
 */
final class ClientMessageFactory implements ClientMessageFactoryInterface
{
    /**
     * @throws RandomException
     */
    public function create(CommandInterface $command): ClientMessage
    {
        return new ClientMessage($command);
    }
}
