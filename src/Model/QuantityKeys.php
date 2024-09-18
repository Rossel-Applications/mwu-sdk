<?php

declare(strict_types=1);

namespace MwuSdk\Model;

use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;

final class QuantityKeys implements QuantityKeysInterface
{
    private bool $enabled = false;
    private QuantityKeysMode $mode = QuantityKeysMode::OFF;

    public function __construct(
        ?bool $enabled = null,
        ?QuantityKeysMode $mode = null,
    ) {
        if (null !== $enabled) {
            $this->enabled = $enabled;
        }

        if (null !== $mode) {
            $this->mode = $mode;
        }
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getMode(): QuantityKeysMode
    {
        return $this->mode;
    }

    public function setMode(QuantityKeysMode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }
}
