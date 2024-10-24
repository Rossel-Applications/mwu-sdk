<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeysInterface;

interface ButtonsConfigInterface
{
    public function getFnButton(): FnButtonInterface;

    public function getQuantityKeys(): QuantityKeysInterface;
}
