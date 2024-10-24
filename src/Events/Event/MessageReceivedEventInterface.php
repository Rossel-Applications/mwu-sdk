<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Event;

use Rossel\MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;

interface MessageReceivedEventInterface extends EventInterface
{
    public function getMessage(): ServerMessageInterface;
}
