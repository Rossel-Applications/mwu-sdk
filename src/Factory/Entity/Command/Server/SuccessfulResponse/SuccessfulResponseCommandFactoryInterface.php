<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Command\Server\SuccessfulResponse;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ServerCommand\SuccessfulResponse\SuccessfulResponseCommandInterface;

interface SuccessfulResponseCommandFactoryInterface
{
    public function supports(string $commandString): bool;

    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): SuccessfulResponseCommandInterface;
}
