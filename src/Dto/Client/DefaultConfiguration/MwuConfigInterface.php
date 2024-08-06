<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

interface MwuConfigInterface
{
    /**
     * @return list<SwitchConfigInterface>
     */
    public function getSwitches(): array;

    public function getBehavior(): BehaviorConfigInterface;
}
