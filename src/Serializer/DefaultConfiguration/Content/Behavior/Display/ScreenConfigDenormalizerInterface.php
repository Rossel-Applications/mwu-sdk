<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\ScreenConfigInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface ScreenConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): ScreenConfigInterface;
}
