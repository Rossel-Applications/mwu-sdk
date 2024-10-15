<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Command\Server\ResponseData;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\ServerCommand\ResponseData\ResponseDataCommandInterface;

interface ResponseDataCommandFactoryInterface
{
    public function supports(string $commandString): bool;

    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): ResponseDataCommandInterface;
}
