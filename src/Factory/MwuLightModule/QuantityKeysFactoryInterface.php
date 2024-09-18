<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use MwuSdk\Model\QuantityKeysInterface;

interface QuantityKeysFactoryInterface
{
    public function create(?QuantityKeysConfigInterface $config): QuantityKeysInterface;
}
