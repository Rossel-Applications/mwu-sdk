<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Manager;

use Rossel\MwuSdk\Events\Event\EventInterface;

interface EventManagerInterface
{
    public function handleEvent(EventInterface $eventData): void;
}
