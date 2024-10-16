<?php

declare(strict_types=1);

namespace MwuSdk\Events\Manager;

use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Listener\EventListenerInterface;

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

    public function handleEvent(EventInterface $eventData): void
    {
        foreach ($this->eventListeners as $listener) {
            if ($listener->supports($eventData)) {
                $listener->handleEvent($eventData);
            }
        }
    }
}
