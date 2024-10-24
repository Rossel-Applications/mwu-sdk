<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\LightConfigInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface LightConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): LightConfigInterface;
}
