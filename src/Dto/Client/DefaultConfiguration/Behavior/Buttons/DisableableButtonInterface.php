<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

interface DisableableButtonInterface
{
    public function isEnabled(): bool;
}
