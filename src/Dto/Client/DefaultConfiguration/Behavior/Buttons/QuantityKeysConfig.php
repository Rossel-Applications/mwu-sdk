<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;

final readonly class QuantityKeysConfig implements QuantityKeysConfigInterface
{
    public function __construct(
        private QuantityKeysMode $mode,
    ) {
    }

    public function getMode(): QuantityKeysMode
    {
        return $this->mode;
    }

    public function isEnabled(): bool
    {
        return QuantityKeysMode::OFF !== $this->getMode();
    }
}
