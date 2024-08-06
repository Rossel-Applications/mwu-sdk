<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;

interface BehaviorConfigInterface
{
    public function getDisplayStatus(): DisplayConfigInterface;

    public function getDisplayStatusAfterConfirm(): DisplayConfigInterface;

    public function getDisplayStatusAfterFn(): DisplayConfigInterface;

    public function getButtons(): ButtonsConfigInterface;
}
