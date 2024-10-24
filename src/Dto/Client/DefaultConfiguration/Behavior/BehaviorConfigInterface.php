<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior;

use Rossel\MwuSdk\Model\DisplayStatusInterface;
use Rossel\MwuSdk\Model\FnButtonInterface;
use Rossel\MwuSdk\Model\QuantityKeysInterface;

interface BehaviorConfigInterface
{
    public function getDisplayStatus(): DisplayStatusInterface;

    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface;

    public function getDisplayStatusAfterFn(): DisplayStatusInterface;

    public function getFnButton(): FnButtonInterface;

    public function getQuantityKeys(): QuantityKeysInterface;
}
