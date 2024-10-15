<?php

declare(strict_types=1);

namespace MwuSdk\Events\Listener;

use MwuSdk\Events\Event\EventInterface;

interface EventListenerInterface
{
    public function supports(EventInterface $eventData): bool;

    public function handleEvent(EventInterface $eventData): void;
}
