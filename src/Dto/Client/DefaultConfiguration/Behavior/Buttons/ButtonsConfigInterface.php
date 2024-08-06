<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

interface ButtonsConfigInterface
{
    public function getConfirm(): ConfirmButtonConfigInterface;

    public function getFn(): FnButtonConfigInterface;

    public function getQuantityKeys(): QuantityKeysConfigInterface;
}
