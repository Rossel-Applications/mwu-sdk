<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface FnButtonConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): FnButtonInterface;
}
