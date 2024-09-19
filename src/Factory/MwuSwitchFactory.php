<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\MwuSwitch;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;

class MwuSwitchFactory implements FactoryInterface
{
    public function create(MwuConfig $config): MwuSwitch
    {
        // todo: implement this method
    }
}
