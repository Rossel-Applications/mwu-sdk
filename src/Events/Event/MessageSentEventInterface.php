<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Event;

use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;

interface MessageSentEventInterface extends EventInterface
{
    public function getMessage(): ClientMessageInterface;
}
