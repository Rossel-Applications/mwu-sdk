<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ServerCommand\ResponseData;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use MwuSdk\Enum\Command\ResponseData\Status;

interface ResponseDataCommandInterface extends ServerCommandInterface
{
    public function getLightModule(): MwuLightModuleInterface;

    public function getStatus(): Status;

    public function getData(): ?string;
}
