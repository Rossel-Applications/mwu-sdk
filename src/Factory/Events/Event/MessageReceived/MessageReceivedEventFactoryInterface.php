<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Events\Event\MessageReceived;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;
use Rossel\MwuSdk\Events\Event\MessageReceivedEventInterface;

interface MessageReceivedEventFactoryInterface
{
    public function createFromStringMessage(
        MwuSwitchInterface $switch,
        string $stringMessage
    ): MessageReceivedEventInterface;

    public function createFromMessage(
        ServerMessageInterface $message,
    ): MessageReceivedEventInterface;
}
