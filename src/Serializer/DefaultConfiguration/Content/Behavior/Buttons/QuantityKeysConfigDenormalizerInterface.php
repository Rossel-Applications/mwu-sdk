<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use Rossel\MwuSdk\Model\QuantityKeysInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface QuantityKeysConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): QuantityKeysInterface;
}
