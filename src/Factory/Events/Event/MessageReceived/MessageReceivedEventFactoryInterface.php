<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Events\Event\MessageReceived;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;
use MwuSdk\Events\Event\MessageReceivedEventInterface;

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
