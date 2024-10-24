<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfigInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface ButtonsConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): ButtonsConfigInterface;
}
