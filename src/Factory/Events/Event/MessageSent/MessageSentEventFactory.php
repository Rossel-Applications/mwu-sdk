<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Events\Event\MessageSent;

use MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use MwuSdk\Events\Event\MessageSentEvent;

final class MessageSentEventFactory implements MessageSentEventFactoryInterface
{
    public function createFromMessage(
        ClientMessageInterface $message,
    ): MessageSentEvent {
        return new MessageSentEvent($message);
    }
}
