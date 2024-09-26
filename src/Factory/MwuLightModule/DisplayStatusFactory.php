<?php

declare(strict_types=1);

namespace MwuSdk\Factory\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use MwuSdk\Model\DisplayStatus;

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
