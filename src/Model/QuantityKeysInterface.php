<?php

declare(strict_types=1);

namespace MwuSdk\Model;

use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;

interface QuantityKeysInterface
{
    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): self;

    public function getMode(): QuantityKeysMode;

    public function setMode(QuantityKeysMode $mode): self;
}
