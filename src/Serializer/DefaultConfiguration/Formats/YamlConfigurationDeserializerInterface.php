<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Formats;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

/**
 * Interface implemented by classes responsible for deserializing YAML configuration files into MwuConfigInterface objects.
 */
interface YamlConfigurationDeserializerInterface extends ConfigurationFileDeserializerInterface
{
    /**
     * Decodes a YAML string into an associative array.
     *
     * @param string $data the YAML string to decode
     *
     * @return array<array-key, mixed> the decoded configuration data
     */
    public function decode(string $data): array;
}
