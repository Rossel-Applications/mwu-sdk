<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ClientCommand\Initialize;

use Rossel\MwuSdk\Entity\Command\ClientCommand\BroadcastReadyCommandInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;

interface InitializeCommandInterface extends ClientCommandInterface, BroadcastReadyCommandInterface
{
}
