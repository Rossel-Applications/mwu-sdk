<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content;

use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\ConfigKeysEnum;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\BehaviorConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Switches\SwitchesConfigDenormalizer;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidator;

final readonly class ConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private ConfigValidator $configValidator,
        private SwitchesConfigDenormalizer $switchesConfigDenormalizer,
        private BehaviorConfigDenormalizer $behaviorConfigDenormalizer,
    ) {
    }

    /** @param array<array-key, mixed> $data */
    public function denormalize(array $data): MwuConfig
    {
        if (\array_key_exists(ConfigKeysEnum::OPTIONAL_ENCAPSULATING_KEY->value, $data)) {
            $data = $data[ConfigKeysEnum::OPTIONAL_ENCAPSULATING_KEY->value];
        }

        $this->configValidator->validate($data);

        $normalizedSwitchesConfig = $data[ConfigKeysEnum::KEY_SWITCHES->value];
        $normalizedBehaviorConfig = $data[ConfigKeysEnum::KEY_BEHAVIOR->value];

        $switchesConfig = $this->switchesConfigDenormalizer->denormalize($normalizedSwitchesConfig);
        $behaviorConfig = $this->behaviorConfigDenormalizer->denormalize($normalizedBehaviorConfig);

        return new MwuConfig($switchesConfig, $behaviorConfig);
    }
}
