<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use MwuSdk\Model\FnButton;

final class FnButtonFactory implements FnButtonFactoryInterface
{
    public function create(?FnButtonConfigInterface $config): FnButton
    {
        return new FnButton(
            $config?->isEnabled(),
            $config?->getText(),
            $config?->isUsedAsDecrement(),
        );
    }
}
