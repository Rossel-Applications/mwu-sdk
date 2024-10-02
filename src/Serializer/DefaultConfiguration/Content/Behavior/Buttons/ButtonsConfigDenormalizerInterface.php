<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfigInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface ButtonsConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): ButtonsConfigInterface;
}
