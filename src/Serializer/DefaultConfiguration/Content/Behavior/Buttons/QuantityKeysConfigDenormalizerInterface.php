<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Model\QuantityKeysInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface QuantityKeysConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): QuantityKeysInterface;
}
