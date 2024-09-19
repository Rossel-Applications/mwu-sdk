<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

final readonly class ButtonsConfig implements ButtonsConfigInterface
{
    public function __construct(
        private ConfirmButtonConfigInterface $confirm,
        private FnButtonConfigInterface $fn,
        private QuantityKeysConfigInterface $quantityKeys,
    ) {
    }

    public function getConfirm(): ConfirmButtonConfigInterface
    {
        return $this->confirm;
    }

    public function getFn(): FnButtonConfigInterface
    {
        return $this->fn;
    }

    public function getQuantityKeys(): QuantityKeysConfigInterface
    {
        return $this->quantityKeys;
    }
}
