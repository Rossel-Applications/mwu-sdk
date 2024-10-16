<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Command\Server\SuccessfulResponse;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\ServerCommand\SuccessfulResponse\SuccessfulResponseCommandInterface;

interface SuccessfulResponseCommandFactoryInterface
{
    public function supports(string $commandString): bool;

    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): SuccessfulResponseCommandInterface;
}
