<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\Mwu;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

final readonly class MwuFactory implements MwuFactoryInterface
{
    public function __construct(
        private MwuSwitchFactory $switchFactory,
    ) {
    }

    public function create(MwuConfigInterface $config): Mwu
    {
        $switches = $this->switchFactory->createCollection($config->getSwitches());

        return new Mwu($switches);
    }
}
