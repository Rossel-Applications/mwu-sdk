<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigInterface;
use MwuSdk\Model\ConfirmButton;

/**
 * Factory class for creating ConfirmButton instances.
 *
 * This class constructs ConfirmButton objects based on the provided configuration.
 */
final class ConfirmButtonFactory implements ConfirmButtonFactoryInterface
{
    public function create(?ConfirmButtonConfigInterface $config): ConfirmButton
    {
        return new ConfirmButton($config?->isEnabled());
    }
}
