<?php

declare(strict_types=1);

namespace MwuSdk\Events\Manager;

use MwuSdk\Entity\Command\ClientCommand\Ack\AckCommand;
use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Event\MessageReceivedEventInterface;
use MwuSdk\Events\Listener\EventListenerInterface;
use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use Random\RandomException;

final class EventManager implements EventManagerInterface
{
    /**
     * @param array<int, EventListenerInterface> $eventListeners
     */
    public function __construct(
        private array $eventListeners = [],
    ) {
    }

    public function addEventListener(EventListenerInterface $eventListener): void
    {
        $this->eventListeners[] = $eventListener;
    }

    public function removeEventListener(EventListenerInterface $eventListener): void
    {
        foreach ($this->eventListeners as $key => $listener) {
            if ($listener === $eventListener) {
                unset($this->eventListeners[$key]);
            }
        }

        // Re-index the array to avoid gaps in the numeric keys
        $this->eventListeners = array_values($this->eventListeners);
    }

    /**
     * @throws RandomException
     * @throws TcpIpClientExceptionInterface
     */
    public function handleEvent(EventInterface $eventData): void
    {
        if ($eventData instanceof MessageReceivedEventInterface) {
            $this->sendAckOnMessageReception($eventData);
        }

        foreach ($this->eventListeners as $listener) {
            if ($listener->supports($eventData)) {
                $listener->handleEvent($eventData);
            }
        }
    }

    private function sendAckOnMessageReception(MessageReceivedEventInterface $messageReceivedEvent): void
    {
        $sequenceNumber = $messageReceivedEvent->getMessage()->getSequenceNumber();
        $switch = $messageReceivedEvent->getMessage()->getCommand()->getSwitch();

        $switch->send(new AckCommand(), $sequenceNumber);
    }
}
