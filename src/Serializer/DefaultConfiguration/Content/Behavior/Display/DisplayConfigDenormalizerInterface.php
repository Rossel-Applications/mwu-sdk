<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use Rossel\MwuSdk\Model\DisplayStatusInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface DisplayConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): DisplayStatusInterface;
}
