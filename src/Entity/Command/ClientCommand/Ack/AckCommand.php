<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ClientCommand\Ack;

use Rossel\MwuSdk\Entity\Command\AbstractCommand;
use Rossel\MwuSdk\Entity\Command\ClientCommand\BroadcastReadyCommandInterface;

final readonly class AckCommand extends AbstractCommand implements AckCommandInterface, BroadcastReadyCommandInterface
{
    public function __construct()
    {
        parent::__construct('O');
    }
}
