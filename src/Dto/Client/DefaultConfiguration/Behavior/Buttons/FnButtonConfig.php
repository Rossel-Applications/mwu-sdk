<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

final readonly class FnButtonConfig implements FnButtonConfigInterface
{
    public function __construct(
        private bool $enabled,
        private string $text,
        private bool $useAsDecrement,
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isUsedAsDecrement(): bool
    {
        return $this->useAsDecrement;
    }
}
