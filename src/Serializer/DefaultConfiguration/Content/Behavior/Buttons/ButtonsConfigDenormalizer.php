<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ButtonsConfigValidator;

final readonly class ButtonsConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private ButtonsConfigValidator $buttonsConfigValidator,
        private ConfirmButtonConfigDenormalizer $confirmButtonConfigDenormalizer,
        private FnButtonConfigDenormalizer $fnButtonConfigDenormalizer,
        private QuantityKeysConfigDenormalizer $quantityKeysConfigDenormalizer,
    ) {
    }

    /** {@inheritDoc} */
    public function denormalize(array $data): ButtonsConfig
    {
        $this->buttonsConfigValidator->validate($data);

        /** @var array<array-key, mixed> $normalizedConfirmButtonConfig */
        $normalizedConfirmButtonConfig = $data[ButtonsConfigKeysEnum::KEY_CONFIRM->value];
        $confirmButtonConfig = $this->confirmButtonConfigDenormalizer->denormalize($normalizedConfirmButtonConfig);

        /** @var array<array-key, mixed> $normalizedFnButtonConfig */
        $normalizedFnButtonConfig = $data[ButtonsConfigKeysEnum::KEY_FN->value];
        $fnButtonConfig = $this->fnButtonConfigDenormalizer->denormalize($normalizedFnButtonConfig);

        /** @var array<array-key, mixed> $normalizedQuantityKeysConfig */
        $normalizedQuantityKeysConfig = $data[ButtonsConfigKeysEnum::KEY_QUANTITY_KEYS->value];
        $quantityKeysConfig = $this->quantityKeysConfigDenormalizer->denormalize($normalizedQuantityKeysConfig);

        return new ButtonsConfig($confirmButtonConfig, $fnButtonConfig, $quantityKeysConfig);
    }
}
