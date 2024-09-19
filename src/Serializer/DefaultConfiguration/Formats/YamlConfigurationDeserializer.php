<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Formats;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;
use MwuSdk\Exception\Configuration\ConfigurationFileNotFoundException;
use MwuSdk\Exception\Configuration\InvalidConfigurationException;
use MwuSdk\Exception\Configuration\InvalidConfigurationFileException;
use MwuSdk\Serializer\AbstractDeserializer;
use MwuSdk\Serializer\DefaultConfiguration\Content\ConfigDenormalizer;
use Symfony\Component\Yaml\Yaml;

/** @extends AbstractDeserializer<MwuConfig> */
final readonly class YamlConfigurationDeserializer extends AbstractDeserializer
{
    public function __construct(
        private ConfigDenormalizer $mwuConfigDenormalizer,
    ) {
    }

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

    public function parseConfiguration(string $data): MwuConfig
    {
        try {
            return $this->deserialize($data);
        } catch (\Exception $exception) {
            throw new InvalidConfigurationException($exception);
        }
    }

    /**
     * @return array<array-key, mixed>
     */
    public function decode(string $data): array
    {
        $decoded = Yaml::parse($data);

        if (false === \is_array($decoded)) {
            throw new InvalidConfigurationException();
        }

        return $decoded;
    }

    public function denormalize(mixed $data): MwuConfig
    {
        return $this->mwuConfigDenormalizer->denormalize($data);
    }
}
