<?php

declare(strict_types=1);

namespace MwuSdk\Events\Event;

use MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;

final readonly class MessageReceivedEvent implements MessageReceivedEventInterface
{
    public function __construct(
        private ServerMessageInterface $message,
    ) {
    }

    public function getMessage(): ServerMessageInterface
    {
        return $this->message;
    }
}