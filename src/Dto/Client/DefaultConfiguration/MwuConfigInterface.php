<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

interface MwuConfigInterface
{
    /**
     * @return list<SwitchConfigInterface>
     */
    public function getSwitches(): array;

    public function getBehavior(): BehaviorConfigInterface;
}
