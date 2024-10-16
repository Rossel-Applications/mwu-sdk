<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Events\Event\MessageReceived;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;
use MwuSdk\Events\Event\MessageReceivedEvent;
use MwuSdk\Events\Event\MessageReceivedEventInterface;
use MwuSdk\Factory\Entity\Message\ServerMessage\ServerMessageFactoryInterface;

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
