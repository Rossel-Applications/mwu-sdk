<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Event;

use Rossel\MwuSdk\Events\Event\EventInterface;

interface EventExceptionInterface extends \Throwable
{
    public function getEvent(): EventInterface;
}
