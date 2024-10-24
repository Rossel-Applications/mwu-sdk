<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Message\ServerMessage;

use Rossel\MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use Rossel\MwuSdk\Entity\Message\MessageInterface;

interface ServerMessageInterface extends MessageInterface
{
    public function getCommand(): ServerCommandInterface;
}
