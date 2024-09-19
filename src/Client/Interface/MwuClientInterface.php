<?php

declare(strict_types=1);

namespace MwuSdk\Client\Interface;

interface MwuClientInterface
{
    /**
     * @return array<array-key, MwuSwitchInterface>
     */
    public function getSwitches(): array;
}
