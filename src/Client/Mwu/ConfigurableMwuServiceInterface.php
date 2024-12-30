<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Client\Mwu;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

interface ConfigurableMwuServiceInterface extends MwuServiceInterface
{
    /**
     * Generates switches from a configuration object.
     *
     * @param array<array-key, mixed>|MwuConfigInterface $config
     */
    public function loadConfiguration(array|MwuConfigInterface $config): self;
}
