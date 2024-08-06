<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\Mwu;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;

final class MwuFactory implements FactoryInterface
{
    public function create(MwuConfig $config): Mwu
    {
        // todo: implement this method
    }
}
