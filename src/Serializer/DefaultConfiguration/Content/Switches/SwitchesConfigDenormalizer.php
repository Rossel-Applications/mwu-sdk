<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Switches\SwitchesConfigValidator;

/**
 * Class SwitchesConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of switches configuration data
 * into an array of SwitchConfig objects. It validates the input data and constructs
 * the configuration objects based on the provided parameters.
 */
final readonly class SwitchesConfigDenormalizer implements DenormalizerInterface
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
     * @param array<array-key, array<array-key, mixed>> $data the configuration data for switches
     *
     * @return list<SwitchConfig> an array of denormalized SwitchConfig objects
     */
    public function denormalize(array $data): array
    {
        $this->switchesConfigValidator->validate($data);

        /** @var array<array-key, array<array-key, mixed>> $normalizedSwitchesConfigurations */
        $normalizedSwitchesConfigurations = $data;

        return array_map(
            function ($switchConfig) {
                return $this->denormalizeItem($switchConfig);
            }, $normalizedSwitchesConfigurations
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
