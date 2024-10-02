<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity;

use MwuSdk\Entity\Command\CommandInterface;
use MwuSdk\Entity\Message;
use Random\RandomException;

final class MessageFactory implements MessageFactoryInterface
{
    /**
     * @throws RandomException
     */
    public function create(CommandInterface $command): Message
    {
        return new Message($command);
    }
}
