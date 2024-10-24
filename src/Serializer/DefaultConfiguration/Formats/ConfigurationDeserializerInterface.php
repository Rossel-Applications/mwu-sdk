<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Formats;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;
use Rossel\MwuSdk\Serializer\DeserializerInterface;

interface ConfigurationDeserializerInterface extends DeserializerInterface
{
    /**
     * Parses a configuration string and returns a MwuConfigInterface instance.
     *
     * @param string $data the configuration string to parse
     *
     * @return MwuConfigInterface the deserialized MwuConfigInterface instance
     */
    public function parseConfiguration(string $data): MwuConfigInterface;

    /**
     * Denormalizes the given data into a MwuConfigInterface instance.
     *
     * @param array<array-key, mixed> $data the data to denormalize
     *
     * @return MwuConfigInterface the denormalized MwuConfigInterface instance
     */
    public function denormalize(mixed $data): MwuConfigInterface;
}
