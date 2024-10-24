<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ServerCommand\ResponseData;

use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use Rossel\MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use Rossel\MwuSdk\Enum\Command\ResponseData\Status;

interface ResponseDataCommandInterface extends ServerCommandInterface
{
    public function getLightModule(): MwuLightModuleInterface;

    public function getStatus(): Status;

    public function getData(): ?string;
}
