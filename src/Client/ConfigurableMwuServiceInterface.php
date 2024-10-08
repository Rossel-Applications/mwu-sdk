<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

interface ConfigurableMwuServiceInterface extends MwuServiceInterface
{
    /**
     * Generates switches from a `\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface` object.
     */
    public function loadConfiguration(MwuConfigInterface $config): self;
}
