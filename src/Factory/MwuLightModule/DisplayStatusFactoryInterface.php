<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use MwuSdk\Model\DisplayStatusInterface;

interface DisplayStatusFactoryInterface
{
    public function create(?DisplayConfigInterface $config): DisplayStatusInterface;
}
