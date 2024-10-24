<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Formats;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;
use Rossel\MwuSdk\Exception\Configuration\ConfigurationFileNotFoundException;
use Rossel\MwuSdk\Exception\Configuration\InvalidConfigurationException;
use Rossel\MwuSdk\Exception\Configuration\InvalidConfigurationFileException;
use Rossel\MwuSdk\Serializer\AbstractDeserializer;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\ConfigDenormalizer;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfigurationDeserializer.
 *
 * Responsible for deserializing YAML configuration files into MwuConfig objects.
 *
 * @extends AbstractDeserializer<MwuConfig>
 */
final readonly class YamlConfigurationDeserializer extends AbstractDeserializer implements YamlConfigurationDeserializerInterface
{
    public function __construct(
        private ConfigDenormalizer $mwuConfigDenormalizer,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @throws ConfigurationFileNotFoundException if the file cannot be found
     * @throws InvalidConfigurationFileException  if the file is invalid
     *
     * @return MwuConfig the deserialized MwuConfig object
     */
    public function parseConfigurationFile(string $path): MwuConfig
    {
        if (false === ($fileContent = file_get_contents($path))) {
            throw new ConfigurationFileNotFoundException($path);
        }

        try {
            return $this->deserialize($fileContent);
        } catch (\Exception $exception) {
            throw new InvalidConfigurationFileException($path, $exception);
        }
    }

    /**
     * Parses a configuration string and returns a MwuConfig object.
     *
     * @param string $data the configuration string to parse
     *
     * @throws InvalidConfigurationException if the configuration is invalid
     *
     * @return MwuConfig the deserialized MwuConfig object
     */
    public function parseConfiguration(string $data): MwuConfig
    {
        try {
            return $this->deserialize($data);
        } catch (\Exception $exception) {
            throw new InvalidConfigurationException($exception);
        }
    }

    /**
     * Decodes a YAML string into an associative array.
     *
     * @param string $data the YAML string to decode
     *
     * @throws InvalidConfigurationException if the decoded data is not an array
     *
     * @return array<array-key, mixed> the decoded configuration data
     */
    public function decode(string $data): array
    {
        $decoded = Yaml::parse($data);

        if (false === \is_array($decoded)) {
            throw new InvalidConfigurationException();
        }

        return $decoded;
    }

    /**
     * Denormalizes the given data into a MwuConfig object.
     *
     * @param array<array-key, mixed> $data the data to denormalize
     *
     * @return MwuConfig the denormalized MwuConfig object
     */
    public function denormalize(mixed $data): MwuConfig
    {
        return $this->mwuConfigDenormalizer->denormalize($data);
    }
}
