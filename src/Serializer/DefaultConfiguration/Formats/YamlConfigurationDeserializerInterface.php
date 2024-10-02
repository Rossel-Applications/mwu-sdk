<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Formats;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;
use MwuSdk\Serializer\DenormalizerInterface;

/**
 * Interface implemented by classes responsible for deserializing YAML configuration files into MwuConfigInterface objects.
 */
interface YamlConfigurationDeserializerInterface extends DenormalizerInterface
{
    /**
     * Parses a configuration file and returns a MwuConfigInterface instance.
     *
     * @param string $path the path to the configuration file
     *
     * @return MwuConfigInterface the deserialized MwuConfigInterface instance
     */
    public function parseConfigurationFile(string $path): MwuConfigInterface;

    /**
     * Parses a configuration string and returns a MwuConfigInterface instance.
     *
     * @param string $data the configuration string to parse
     *
     * @return MwuConfigInterface the deserialized MwuConfigInterface instance
     */
    public function parseConfiguration(string $data): MwuConfigInterface;

    /**
     * Decodes a YAML string into an associative array.
     *
     * @param string $data the YAML string to decode
     *
     * @return array<array-key, mixed> the decoded configuration data
     */
    public function decode(string $data): array;

    /**
     * Denormalizes the given data into a MwuConfigInterface instance.
     *
     * @param array<array-key, mixed> $data the data to denormalize
     *
     * @return MwuConfigInterface the denormalized MwuConfigInterface instance
     */
    public function denormalize(mixed $data): MwuConfigInterface;
}
