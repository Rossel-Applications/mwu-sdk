<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Events\Event\MessageSent;

use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use Rossel\MwuSdk\Events\Event\MessageSentEvent;

interface MessageSentEventFactoryInterface
{
    public function createFromMessage(
        ClientMessageInterface $message,
    ): MessageSentEvent;
}
