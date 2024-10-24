<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\ScreenConfigInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface ScreenConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): ScreenConfigInterface;
}
