<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Model\ConfirmButtonInterface;
use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeysInterface;

interface MwuLightModuleInterface
{
    public function getId(): ?int;

    public function getDisplayStatus(): DisplayStatusInterface;

    public function getDisplayStatusAfterFn(): DisplayStatusInterface;

    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface;

    public function getConfirmButton(): ConfirmButtonInterface;

    public function getFnButton(): FnButtonInterface;

    public function getQuantityKeys(): QuantityKeysInterface;

    public function getSwitch(): ?MwuSwitchInterface;

    public function connectSwitch(MwuSwitchInterface $switch, int $id): self;

    public function disconnectSwitch(): self;
}
