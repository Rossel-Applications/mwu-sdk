<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigInterface;
use MwuSdk\Model\ConfirmButton;

final class ConfirmButtonFactory implements ConfirmButtonFactoryInterface
{
    public function create(?ConfirmButtonConfigInterface $config): ConfirmButton
    {
        return new ConfirmButton($config?->isEnabled());
    }
}
