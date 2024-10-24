<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use MwuSdk\Model\FnButton;

/**
 * Factory class for creating FnButton instances.
 *
 * This class constructs FnButton objects based on the provided configuration.
 */
final class FnButtonFactory implements FnButtonFactoryInterface
{
    public function create(?FnButtonConfigInterface $config): FnButton
    {
        return new FnButton(
            $config?->getText(),
        );
    }
}
