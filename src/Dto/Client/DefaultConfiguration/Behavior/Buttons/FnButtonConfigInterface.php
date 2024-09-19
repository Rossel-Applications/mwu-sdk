<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

interface FnButtonConfigInterface extends DisableableButtonInterface
{
    public function getText(): string;

    public function isUsedAsDecrement(): bool;
}
