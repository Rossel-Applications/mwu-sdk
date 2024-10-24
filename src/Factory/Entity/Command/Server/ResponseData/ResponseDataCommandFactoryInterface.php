<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Command\Server\ResponseData;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ServerCommand\ResponseData\ResponseDataCommandInterface;

interface ResponseDataCommandFactoryInterface
{
    public function supports(string $commandString): bool;

    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): ResponseDataCommandInterface;
}
