<?php

declare(strict_types=1);

namespace MwuSdk\Model;

final class ConfirmButton implements ConfirmButtonInterface
{
    private bool $enabled = false;

    public function __construct(
        ?bool $enabled = null,
    ) {
        if (null !== $enabled) {
            $this->enabled = $enabled;
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
}
