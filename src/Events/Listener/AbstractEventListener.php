<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Listener;

use Rossel\MwuSdk\Events\Event\EventInterface;
use Rossel\MwuSdk\Exception\Event\Listener\CannotHandleEventException;

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
