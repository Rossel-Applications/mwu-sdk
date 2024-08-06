<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;

interface FactoryInterface
{
    public function create(MwuConfig $config): mixed;
}
