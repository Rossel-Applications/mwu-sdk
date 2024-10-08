<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity;

use MwuSdk\Entity\Command\CommandInterface;
use MwuSdk\Entity\MessageInterface;

/**
 * Interface for factories that create Message instances from Command objects.
 */
interface ClientMessageFactoryInterface
{
    public function create(CommandInterface $command): MessageInterface;
}
