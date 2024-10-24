<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Formats;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

interface ConfigurationFileDeserializerInterface extends ConfigurationDeserializerInterface
{
    /**
     * Parses a configuration file and returns a MwuConfigInterface instance.
     *
     * @param string $path the path to the configuration file
     *
     * @return MwuConfigInterface the deserialized MwuConfigInterface instance
     */
    public function parseConfigurationFile(string $path): MwuConfigInterface;
}
