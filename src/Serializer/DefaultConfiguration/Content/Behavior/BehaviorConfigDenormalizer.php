<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\BehaviorConfigKeysEnum;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ButtonsConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\DisplayConfigDenormalizer;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\BehaviorConfigValidator;

final readonly class BehaviorConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private BehaviorConfigValidator $behaviorConfigValidator,
        private ButtonsConfigDenormalizer $buttonsConfigDenormalizer,
        private DisplayConfigDenormalizer $displayConfigDenormalizer,
    ) {
    }

    /** {@inheritDoc} */
    public function denormalize(array $data): BehaviorConfig
    {
        $this->behaviorConfigValidator->validate($data);

        /** @var array<array-key, mixed> $normalizedDisplayStatusConfig */
        $normalizedDisplayStatusConfig = $data[BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS->value];
        /** @var array<array-key, mixed> $normalizedDisplayStatusAfterConfirmConfig */
        $normalizedDisplayStatusAfterConfirmConfig = $data[BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS_AFTER_CONFIRM->value];
        /** @var array<array-key, mixed> $normalizedDisplayStatusAfterFnConfig */
        $normalizedDisplayStatusAfterFnConfig = $data[BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS_AFTER_FN->value];
        /** @var array<array-key, mixed> $normalizedButtonsConfig */
        $normalizedButtonsConfig = $data[BehaviorConfigKeysEnum::KEY_BUTTONS->value];

        $displayStatus = $this->displayConfigDenormalizer->denormalize($normalizedDisplayStatusConfig);
        $displayStatusAfterConfirmConfig = $this->displayConfigDenormalizer->denormalize($normalizedDisplayStatusAfterConfirmConfig);
        $displayStatusAfterFnConfig = $this->displayConfigDenormalizer->denormalize($normalizedDisplayStatusAfterFnConfig);
        $buttonsConfig = $this->buttonsConfigDenormalizer->denormalize($normalizedButtonsConfig);

        return new BehaviorConfig($displayStatus, $displayStatusAfterConfirmConfig, $displayStatusAfterFnConfig, $buttonsConfig);
    }
}
