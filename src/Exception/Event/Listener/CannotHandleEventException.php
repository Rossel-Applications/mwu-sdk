<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Event\Listener;

use Rossel\MwuSdk\Events\Event\EventInterface;

final class CannotHandleEventException extends \RuntimeException implements EventListenerExceptionInterface
{
    private const MESSAGE_TEMPLATE = 'Cannot handle event of type "%s"';

    public function __construct(
        private readonly EventInterface $event,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(
            sprintf(self::MESSAGE_TEMPLATE, $this->event::class),
            0,
            $previous,
        );
    }

    public function getEvent(): EventInterface
    {
        return $this->event;
    }
}
