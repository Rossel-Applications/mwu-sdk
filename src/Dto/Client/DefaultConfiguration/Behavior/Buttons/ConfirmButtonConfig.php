<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

final readonly class ConfirmButtonConfig implements ConfirmButtonConfigInterface
{
    public function __construct(
        private bool $enabled,
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
