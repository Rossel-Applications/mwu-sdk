<?php

namespace MwuSdk\Events\Listener;

use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Listener\EventListenerInterface;
use MwuSdk\Exception\Event\Listener\CannotHandleEventException;

abstract class AbstractEventListener implements EventListenerInterface
{
    public function handleEvent(EventInterface $eventData): void
    {
        if (false === $this->supports($eventData)) {
            throw new CannotHandleEventException($eventData);
        }
    }
}
