<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Client\Mwu;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

interface ConfigurableMwuServiceInterface extends MwuServiceInterface
{
    /**
     * Generates switches from a `\Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface` object.
     */
    public function loadConfiguration(MwuConfigInterface $config): self;
}
