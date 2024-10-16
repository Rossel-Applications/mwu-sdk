<?php

declare(strict_types=1);

namespace MwuSdk\Events\Dispatcher;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Manager\EventManagerInterface;
use MwuSdk\Factory\Events\Event\MessageReceived\MessageReceivedEventFactoryInterface;
use MwuSdk\Factory\Events\Event\MessageSent\MessageSentEventFactoryInterface;

final readonly class EventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private EventManagerInterface $eventManager,
        private MessageSentEventFactoryInterface $messageSentEventFactory,
        private MessageReceivedEventFactoryInterface $messageReceivedEventFactory,
    ) {
    }

    public function dispatchEvent(EventInterface $event): void
    {
        $this->eventManager->handleEvent($event);
    }

    public function dispatchMessageReceivedEvent(
        MwuSwitchInterface $switch,
        string $stringMessage,
    ): void {
        $this->dispatchEvent(
            $this->messageReceivedEventFactory->createFromStringMessage($switch, $stringMessage)
        );
    }

    public function dispatchMessageSentEvent(
        ClientMessageInterface $message
    ): void {
        $this->dispatchEvent(
            $this->messageSentEventFactory->createFromMessage($message)
        );
    }
}
