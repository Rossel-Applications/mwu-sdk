<?php

declare(strict_types=1);

namespace MwuSdk\Events\Event;

use MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;

interface MessageReceivedEventInterface extends EventInterface
{
    public function getMessage(): ServerMessageInterface;
}
