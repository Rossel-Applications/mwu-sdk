<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Events\Event\MessageReceived;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;
use Rossel\MwuSdk\Events\Event\MessageReceivedEvent;
use Rossel\MwuSdk\Events\Event\MessageReceivedEventInterface;
use Rossel\MwuSdk\Factory\Entity\Message\ServerMessage\ServerMessageFactoryInterface;

final readonly class MessageReceivedEventFactory implements MessageReceivedEventFactoryInterface
{
    public function __construct(
        private ServerMessageFactoryInterface $messageFactory,
    ) {
    }

    public function createFromStringMessage(
        MwuSwitchInterface $switch,
        string $stringMessage
    ): MessageReceivedEventInterface {
        return new MessageReceivedEvent(
            $this->messageFactory->createFromString($switch, $stringMessage),
        );
    }

    public function createFromMessage(
        ServerMessageInterface $message,
    ): MessageReceivedEventInterface {
        return new MessageReceivedEvent($message);
    }
}
