<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use Rossel\MwuSdk\Model\FnButtonInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface FnButtonConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): FnButtonInterface;
}
