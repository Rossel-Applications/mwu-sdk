<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Switches\SwitchesConfigValidator;

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
     * @return list<SwitchConfig>
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

    /** @param array<array-key, mixed> $itemConfig */
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
