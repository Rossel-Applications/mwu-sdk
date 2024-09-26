<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use MwuSdk\Model\QuantityKeys;

final class QuantityKeysFactory implements QuantityKeysFactoryInterface
{
    public function create(?QuantityKeysConfigInterface $config): QuantityKeys
    {
        return new QuantityKeys(
            $config?->isEnabled(),
            $config?->getMode(),
        );
    }
}
