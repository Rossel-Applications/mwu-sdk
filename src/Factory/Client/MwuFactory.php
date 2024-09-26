<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\Mwu;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

/**
 * Factory class for creating Mwu client instances.
 *
 * This class constructs an instance of the Mwu client using the specified configuration.
 */
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
