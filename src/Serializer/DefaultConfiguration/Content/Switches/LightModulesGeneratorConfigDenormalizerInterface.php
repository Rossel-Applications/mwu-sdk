<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface LightModulesGeneratorConfigDenormalizerInterface extends DenormalizerInterface
{
    public function denormalize(array $data): LightModulesGeneratorConfigInterface;
}
