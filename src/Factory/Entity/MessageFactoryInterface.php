<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity;

use MwuSdk\Entity\Command\CommandInterface;
use MwuSdk\Entity\MessageInterface;

interface MessageFactoryInterface
{
    public function create(CommandInterface $command): MessageInterface;
}
