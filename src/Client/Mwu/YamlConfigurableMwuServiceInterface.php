<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Client\Mwu;

interface YamlConfigurableMwuServiceInterface extends ConfigurableMwuServiceInterface
{
    /**
     * Generates switches from a YAML configuration file, specified by its path.
     */
    public function loadYamlConfigurationFile(string $path): self;
}
