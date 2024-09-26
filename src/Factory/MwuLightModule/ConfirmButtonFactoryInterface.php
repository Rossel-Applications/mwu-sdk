<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigInterface;
use MwuSdk\Model\ConfirmButtonInterface;

interface ConfirmButtonFactoryInterface
{
    public function create(?ConfirmButtonConfigInterface $config): ConfirmButtonInterface;
}
