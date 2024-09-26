<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Configuration;

use MwuSdk\Client\MwuSwitchInterface;

class CannotAssignIdOnSwitchException extends \RuntimeException
{
    public function __construct(MwuSwitchInterface $switch, ?int $id, ?\Throwable $previous = null)
    {
        $switchIdentifier = $switch->getUniqueIdentifier();
        $message = sprintf(
            "Cannot assign Light Module Id #%s for switch '%s",
            $id ? (string) $id : 'null', $switchIdentifier,
        );

        parent::__construct($message, 0, $previous);
    }
}
