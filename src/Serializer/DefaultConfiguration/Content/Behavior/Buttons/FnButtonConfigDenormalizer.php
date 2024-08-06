<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\FnButtonConfigValidator;

final readonly class FnButtonConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private FnButtonConfigValidator $fnButtonConfigValidator,
    ) {
    }

    public function denormalize(array $data): FnButtonConfig
    {
        $this->fnButtonConfigValidator->validate($data);

        /** @var bool $enabled */
        $enabled = $data[FnButtonConfigKeysEnum::KEY_ENABLED->value];
        /** @var string $text */
        $text = $data[FnButtonConfigKeysEnum::KEY_TEXT->value];
        /** @var bool $useAsDecrement */
        $useAsDecrement = $data[FnButtonConfigKeysEnum::KEY_USE_AS_DECREMENT->value];

        return new FnButtonConfig($enabled, $text, $useAsDecrement);
    }
}
