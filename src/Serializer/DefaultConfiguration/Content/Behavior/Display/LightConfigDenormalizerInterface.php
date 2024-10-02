<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\LightConfigInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface LightConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): LightConfigInterface;
}
