<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use MwuSdk\Model\FnButtonInterface;

interface FnButtonFactoryInterface
{
    public function create(?FnButtonConfigInterface $config): FnButtonInterface;
}
