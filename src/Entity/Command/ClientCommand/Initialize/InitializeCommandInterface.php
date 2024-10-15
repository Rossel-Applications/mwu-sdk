<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ClientCommand\Initialize;

use MwuSdk\Entity\Command\ClientCommand\BroadcastReadyCommandInterface;
use MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;

interface InitializeCommandInterface extends ClientCommandInterface, BroadcastReadyCommandInterface
{
}
