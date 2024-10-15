<?php

declare(strict_types=1);

namespace MwuSdk\Events\Event;

use MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;

interface MessageSentEventInterface extends EventInterface
{
    public function getMessage(): ClientMessageInterface;
}
