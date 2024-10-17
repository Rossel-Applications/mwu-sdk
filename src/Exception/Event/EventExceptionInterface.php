<?php

namespace MwuSdk\Exception\Event;

use MwuSdk\Events\Event\EventInterface;

interface EventExceptionInterface extends \Throwable
{
    public function getEvent(): EventInterface;
}
