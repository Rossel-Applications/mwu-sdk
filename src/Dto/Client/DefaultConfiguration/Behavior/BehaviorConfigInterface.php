<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior;

use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeysInterface;

interface BehaviorConfigInterface
{
    public function getDisplayStatus(): DisplayStatusInterface;

    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface;

    public function getDisplayStatusAfterFn(): DisplayStatusInterface;

    public function getFnButton(): FnButtonInterface;

    public function getQuantityKeys(): QuantityKeysInterface;
}
