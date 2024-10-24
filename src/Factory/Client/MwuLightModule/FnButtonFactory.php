<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client\MwuLightModule;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use Rossel\MwuSdk\Model\FnButton;

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
