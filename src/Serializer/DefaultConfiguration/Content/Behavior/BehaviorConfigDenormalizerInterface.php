<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface BehaviorConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): BehaviorConfigInterface;
}
