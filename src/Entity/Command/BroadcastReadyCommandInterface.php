<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command;

/**
 * Interface implemented by commands that can individually be broadcasted.
 *
 * Commands implementing this interface are ready to be broadcasted without additional processing.
 */
interface BroadcastReadyCommandInterface extends CommandInterface
{
}
