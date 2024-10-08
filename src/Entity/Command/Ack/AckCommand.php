<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\Ack;

use MwuSdk\Entity\Command\AbstractCommand;
use MwuSdk\Entity\Command\BroadcastReadyCommandInterface;

final readonly class AckCommand extends AbstractCommand implements AckCommandInterface, BroadcastReadyCommandInterface
{
    public function __construct()
    {
        parent::__construct('O');
    }
}
