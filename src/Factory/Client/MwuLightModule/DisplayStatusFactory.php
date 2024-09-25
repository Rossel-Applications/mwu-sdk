<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use MwuSdk\Model\DisplayStatus;

/**
 * Factory class for creating DisplayStatus instances.
 *
 * This class constructs DisplayStatus objects based on the provided configuration.
 */
final class DisplayStatusFactory implements DisplayStatusFactoryInterface
{
    public function create(?DisplayConfigInterface $config): DisplayStatus
    {
        return new DisplayStatus(
            $config?->getLight()->getMode(),
            $config?->getScreen()->getMode(),
            $config?->getLight()->getColor(),
            $config?->getScreen()->getText(),
        );
    }
}
