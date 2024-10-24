<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface BehaviorConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): BehaviorConfigInterface;
}
