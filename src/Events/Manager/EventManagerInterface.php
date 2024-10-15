<?php

declare(strict_types=1);

namespace MwuSdk\Events\Manager;

use MwuSdk\Events\Event\EventInterface;

interface EventManagerInterface
{
    public function handleEvent(EventInterface $eventData): void;
}
