<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Message\ClientMessage;

use MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;
use MwuSdk\Entity\Message\MessageInterface;

/**
 * Interface for factories that create Message instances from Command objects.
 */
interface ClientMessageFactoryInterface
{
    public function create(ClientCommandInterface $command, ?string $sequenceNumber = null): MessageInterface;
}
