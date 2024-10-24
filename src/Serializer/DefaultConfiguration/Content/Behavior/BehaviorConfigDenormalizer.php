<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfig;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\BehaviorConfigKeysEnum;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ButtonsConfigDenormalizerInterface;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\DisplayConfigDenormalizerInterface;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\BehaviorConfigValidator;

/**
 * Class BehaviorConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of behavior configuration data
 * into a BehaviorConfig object. It validates the input data and extracts the display
 * configurations and buttons configurations using their respective denormalizers.
 */
final readonly class BehaviorConfigDenormalizer implements BehaviorConfigDenormalizerInterface
{
    public function __construct(
        private BehaviorConfigValidator $behaviorConfigValidator,
        private ButtonsConfigDenormalizerInterface $buttonsConfigDenormalizer,
        private DisplayConfigDenormalizerInterface $displayConfigDenormalizer,
    ) {
    }

    /**
     * {@inheritDoc}
     */
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

        return new BehaviorConfig(
            $displayStatus,
            $displayStatusAfterConfirmConfig,
            $displayStatusAfterFnConfig,
            $buttonsConfig->getFnButton(),
            $buttonsConfig->getQuantityKeys(),
        );
    }
}
