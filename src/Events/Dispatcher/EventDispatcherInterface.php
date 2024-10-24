<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Dispatcher;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use Rossel\MwuSdk\Events\Event\EventInterface;

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
