<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Manager;

use Random\RandomException;
use Rossel\MwuSdk\Events\Event\EventInterface;
use Rossel\MwuSdk\Events\Listener\EventListenerInterface;
use Rossel\MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;

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
