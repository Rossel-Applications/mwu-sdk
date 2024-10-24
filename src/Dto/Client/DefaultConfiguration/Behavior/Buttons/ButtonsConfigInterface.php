<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

use Rossel\MwuSdk\Model\FnButtonInterface;
use Rossel\MwuSdk\Model\QuantityKeysInterface;

interface ButtonsConfigInterface
{
    public function getFnButton(): FnButtonInterface;

    public function getQuantityKeys(): QuantityKeysInterface;
}
