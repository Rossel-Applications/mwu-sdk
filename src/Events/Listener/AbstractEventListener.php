<?php

declare(strict_types=1);

namespace MwuSdk\Events\Listener;

use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Exception\Event\Listener\CannotHandleEventException;

abstract class AbstractEventListener implements EventListenerInterface
{
    protected function validate(EventInterface $eventData): true
    {
        if (false === $this->supports($eventData)) {
            throw new CannotHandleEventException($eventData);
        }

        return true;
    }
}
