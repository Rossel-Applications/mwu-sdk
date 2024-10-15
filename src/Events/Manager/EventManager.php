<?php

declare(strict_types=1);

namespace MwuSdk\Events\Manager;

use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Listener\EventListenerInterface;
use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use Random\RandomException;

final class EventManager implements EventManagerInterface
{
    /**
     * @param iterable<EventListenerInterface> $eventListeners
     */
    public function __construct(
        private readonly iterable $eventListeners,
    ) {
    }

    /**
     * @throws RandomException
     * @throws TcpIpClientExceptionInterface
     */
    public function handleEvent(EventInterface $eventData): void
    {
        foreach ($this->eventListeners as $listener) {
            if ($listener->supports($eventData)) {
                $listener->handleEvent($eventData);
            }
        }
    }
}
