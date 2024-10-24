<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

interface LightModulesGeneratorConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): LightModulesGeneratorConfigInterface;
}
