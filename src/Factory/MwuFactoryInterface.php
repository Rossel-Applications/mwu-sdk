<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\MwuClientInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

interface MwuFactoryInterface
{
    public function create(MwuConfigInterface $config): MwuClientInterface;
}
