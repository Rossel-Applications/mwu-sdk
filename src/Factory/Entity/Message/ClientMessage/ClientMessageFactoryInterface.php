<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Message\ClientMessage;

use Rossel\MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;
use Rossel\MwuSdk\Entity\Message\MessageInterface;

/**
 * Interface for factories that create Message instances from Command objects.
 */
interface ClientMessageFactoryInterface
{
    public function create(ClientCommandInterface $command, ?string $sequenceNumber = null): MessageInterface;
}
