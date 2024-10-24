<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Event;

use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;

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
