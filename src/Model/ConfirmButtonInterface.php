<?php

declare(strict_types=1);

namespace MwuSdk\Model;

interface ConfirmButtonInterface
{
    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): self;
}
