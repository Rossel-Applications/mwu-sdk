<?php

declare(strict_types=1);

namespace MwuSdk\Events\Manager;

use MwuSdk\Client\TcpIp\TcpIpClientInterface;
use MwuSdk\Entity\Command\ClientCommand\Ack\AckCommand;
use MwuSdk\Entity\Message\ClientMessage\ClientMessage;
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
        private readonly TcpIpClientInterface $tcpIpClient,
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
            $this->ackOnMessageReception($eventData);
        }

        foreach ($this->eventListeners as $listener) {
            if ($listener->supports($eventData)) {
                $listener->handleEvent($eventData);
            }
        }
    }

    /**
     * @throws RandomException
     * @throws TcpIpClientExceptionInterface
     */
    private function ackOnMessageReception(MessageReceivedEventInterface $messageReceivedEvent): void
    {
        $sequenceNumber = $messageReceivedEvent->getMessage()->getSequenceNumber();

        $ackMessage = new ClientMessage(new AckCommand(), $sequenceNumber);

        $this->tcpIpClient->sendMessage((string) $ackMessage);
    }
}
