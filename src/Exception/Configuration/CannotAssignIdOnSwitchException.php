<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Configuration;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;

/**
 * Error thrown when it is not possible for a switch to assign an id to a light module.
 */
final class CannotAssignIdOnSwitchException extends \RuntimeException implements ConfigurationExceptionInterface
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
