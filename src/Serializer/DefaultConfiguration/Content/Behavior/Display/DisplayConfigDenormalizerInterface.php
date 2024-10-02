<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface DisplayConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): DisplayStatusInterface;
}
