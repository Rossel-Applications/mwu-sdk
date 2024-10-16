<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Message\ServerMessage;

use MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use MwuSdk\Entity\Message\MessageInterface;

interface ServerMessageInterface extends MessageInterface
{
    public function getCommand(): ServerCommandInterface;
}
