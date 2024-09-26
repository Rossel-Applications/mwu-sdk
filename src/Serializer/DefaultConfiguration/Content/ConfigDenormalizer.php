<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\ConfigKeysEnum;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\BehaviorConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Switches\SwitchesConfigDenormalizer;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidator;

/**
 * Class ConfigDenormalizer.
 *
 * This class is responsible for denormalizing the configuration data into an MwuConfig object.
 * It validates the input data and processes the switches and behavior configurations.
 */
final readonly class ConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private ConfigValidator $configValidator,
        private SwitchesConfigDenormalizer $switchesConfigDenormalizer,
        private BehaviorConfigDenormalizer $behaviorConfigDenormalizer,
    ) {
    }

    /**
     * Denormalizes the provided data into an MwuConfig object.
     *
     * @param array<array-key, mixed> $data the configuration data to denormalize
     *
     * @return MwuConfig the denormalized MwuConfig object
     */
    public function denormalize(array $data): MwuConfig
    {
        if (\array_key_exists(ConfigKeysEnum::OPTIONAL_ENCAPSULATING_KEY->value, $data)) {
            $data = $data[ConfigKeysEnum::OPTIONAL_ENCAPSULATING_KEY->value];
        }

        $this->configValidator->validate($data);

        /** @var array<array-key, array<array-key, mixed>> $normalizedSwitchesConfig */
        $normalizedSwitchesConfig = $data[ConfigKeysEnum::KEY_SWITCHES->value];
        /** @var array<array-key, array<array-key, mixed>> $normalizedBehaviorConfig */
        $normalizedBehaviorConfig = $data[ConfigKeysEnum::KEY_BEHAVIOR->value];

        $switchesConfig = $this->switchesConfigDenormalizer->denormalize($normalizedSwitchesConfig);
        $behaviorConfig = $this->behaviorConfigDenormalizer->denormalize($normalizedBehaviorConfig);

        return new MwuConfig($switchesConfig, $behaviorConfig);
    }
}
