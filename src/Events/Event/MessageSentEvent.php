<?php

declare(strict_types=1);

namespace MwuSdk\Events\Event;

use MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;

final readonly class MessageSentEvent implements MessageSentEventInterface
{
    public function __construct(
        private ClientMessageInterface $message,
    ) {
    }

    public function getMessage(): ClientMessageInterface
    {
        return $this->message;
    }
}
