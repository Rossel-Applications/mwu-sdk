<?php

declare(strict_types=1);

namespace MwuSdk\Events\Manager;

use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Listener\EventListenerInterface;

interface EventManagerInterface
{
    public function addEventListener(EventListenerInterface $eventListener): void;

    public function removeEventListener(EventListenerInterface $eventListener): void;

    public function handleEvent(EventInterface $eventData): void;
}
