<?php

declare(strict_types=1);

namespace MwuSdk\Model;

interface FnButtonInterface
{
    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): self;

    public function getText(): string;

    public function setText(string $text): self;

    public function isUseAsDecrement(): bool;

    public function setUseAsDecrement(bool $useAsDecrement): self;
}
