<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Listener;

use Rossel\MwuSdk\Events\Event\EventInterface;

interface EventListenerInterface
{
    public function supports(EventInterface $eventData): bool;

    public function handleEvent(EventInterface $eventData): void;
}
