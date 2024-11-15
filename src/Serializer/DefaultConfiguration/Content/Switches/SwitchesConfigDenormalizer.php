<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Switches\SwitchesConfigValidator;

/**
 * This class is responsible for denormalizing an array of switches configuration data
 * into an array of SwitchConfig objects. It validates the input data and constructs
 * the configuration objects based on the provided parameters.
 */
final readonly class SwitchesConfigDenormalizer implements SwitchesConfigDenormalizerInterface
{
    public function __construct(
        private SwitchesConfigValidator $switchesConfigValidator,
        private LightModulesGeneratorConfigDenormalizer $lightModuleGeneratorConfigDenormalizer,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * Denormalizes the given data into an array of SwitchConfig objects.
     *
     * @param list<array<array-key, mixed>> $data the configuration data for switches
     *
     * @return list<SwitchConfig> an array of denormalized SwitchConfig objects
     */
    public function denormalize(array $data): array
    {
        $this->switchesConfigValidator->validate($data);

        /** @var array<array-key, array<array-key, mixed>> $normalizedSwitchesConfigurations */
        $normalizedSwitchesConfigurations = $data;

        /* @var list<SwitchConfig> */
        return array_map(
            function ($switchConfig): SwitchConfig {
                return $this->denormalizeItem($switchConfig);
            },
            $normalizedSwitchesConfigurations,
        );
    }

    /**
     * Denormalizes an individual switch configuration item into a SwitchConfig object.
     *
     * @param array<array-key, mixed> $itemConfig the configuration data for a single switch
     *
     * @return SwitchConfig the denormalized SwitchConfig object
     */
    public function denormalizeItem(array $itemConfig): SwitchConfig
    {
        /** @var string $ipAddress */
        $ipAddress = $itemConfig[SwitchesConfigKeysEnum::ITEM_KEY_IP_ADDRESS->value];
        /** @var int $port */
        $port = $itemConfig[SwitchesConfigKeysEnum::ITEM_KEY_IP_PORT->value];
        /** @var array<array-key, mixed> $normalizedLightModulesGenerator */
        $normalizedLightModulesGenerator = $itemConfig[SwitchesConfigKeysEnum::ITEM_KEY_LIGHT_MODULES_GENERATOR->value];

        $lightModulesGenerator = $this->lightModuleGeneratorConfigDenormalizer->denormalize($normalizedLightModulesGenerator);

        return new SwitchConfig($ipAddress, $port, $lightModulesGenerator);
    }
}
