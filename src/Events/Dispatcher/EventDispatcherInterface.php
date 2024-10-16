<?php

declare(strict_types=1);

namespace MwuSdk\Events\Dispatcher;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use MwuSdk\Events\Event\EventInterface;

interface EventDispatcherInterface
{
    public function dispatchEvent(EventInterface $event): void;

    public function dispatchMessageReceivedEvent(
        MwuSwitchInterface $switch,
        string $stringMessage,
        \Socket $socket,
    ): void;

    public function dispatchMessageSentEvent(
        ClientMessageInterface $message
    ): void;
}
