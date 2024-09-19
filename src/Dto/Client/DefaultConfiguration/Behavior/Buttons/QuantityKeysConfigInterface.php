<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;

interface QuantityKeysConfigInterface extends DisableableButtonInterface
{
    public function getMode(): QuantityKeysMode;
}
