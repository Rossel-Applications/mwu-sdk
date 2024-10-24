<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;

interface QuantityKeysConfigInterface extends DisableableButtonInterface
{
    public function getMode(): QuantityKeysMode;
}
