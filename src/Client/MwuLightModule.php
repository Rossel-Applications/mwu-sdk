<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Model\ConfirmButton;
use MwuSdk\Model\ConfirmButtonInterface;
use MwuSdk\Model\DisplayStatus;
use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Model\FnButton;
use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeys;
use MwuSdk\Model\QuantityKeysInterface;

/**
 * This class is responsible for managing interactions with individual MWU light modules.
 * It provides methods to send specific commands to a light module.
 */
final class MwuLightModule implements MwuLightModuleInterface
{
    private ?MwuSwitchInterface $switch;
    private ?int $id;
    private DisplayStatusInterface $displayStatus;
    private DisplayStatusInterface $displayStatusAfterConfirm;
    private DisplayStatusInterface $displayStatusAfterFn;
    private ConfirmButtonInterface $confirmButton;
    private FnButtonInterface $fnButton;
    private QuantityKeysInterface $quantityKeys;

    public function __construct(
        MwuSwitchInterface $switch,
        int $id,
        ?DisplayStatusInterface $displayStatus = null,
        ?DisplayStatusInterface $displayStatusAfterConfirm = null,
        ?DisplayStatusInterface $displayStatusAfterFn = null,
        ?ConfirmButtonInterface $confirmButton = null,
        ?FnButtonInterface $fnButton = null,
        ?QuantityKeysInterface $quantityKeys = null,
    ) {
        $this
            ->connectSwitch($switch, $id)
            ->setDisplayStatus($displayStatus ?? new DisplayStatus())
            ->setDisplayStatusAfterConfirm($displayStatusAfterConfirm ?? new DisplayStatus())
            ->setDisplayStatusAfterFn($displayStatusAfterFn ?? new DisplayStatus())
            ->setConfirmButton($confirmButton ?? new ConfirmButton())
            ->setFnButton($fnButton ?? new FnButton())
            ->setQuantityKeys($quantityKeys ?? new QuantityKeys());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplayStatus(): DisplayStatusInterface
    {
        return $this->displayStatus;
    }

    public function getDisplayStatusAfterFn(): DisplayStatusInterface
    {
        return $this->displayStatusAfterFn;
    }

    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface
    {
        return $this->displayStatusAfterConfirm;
    }

    public function getSwitch(): ?MwuSwitchInterface
    {
        return $this->switch;
    }

    public function getConfirmButton(): ConfirmButtonInterface
    {
        return $this->confirmButton;
    }

    public function getFnButton(): FnButtonInterface
    {
        return $this->fnButton;
    }

    public function getQuantityKeys(): QuantityKeysInterface
    {
        return $this->quantityKeys;
    }

    public function connectSwitch(MwuSwitchInterface $switch, int $id): self
    {
        return $this
            ->setSwitch($switch)
            ->setId($id);
    }

    public function disconnectSwitch(): self
    {
        $switch = $this->getSwitch();

        if (null !== $switch
            && \in_array($this, $switch->getLightModules(), true)
        ) {
            $switch->removeLightModule($this);
        }

        if (null !== $this->switch) {
            $this->setSwitch(null);
        }

        if (null !== $this->id) {
            $this->setId(null);
        }

        return $this;
    }

    private function setSwitch(?MwuSwitchInterface $switch): self
    {
        $switch?->addLightModule($this);
        $this->switch = $switch;

        return $this;
    }

    private function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    private function setDisplayStatus(DisplayStatusInterface $displayStatus): self
    {
        $this->displayStatus = $displayStatus;

        return $this;
    }

    private function setDisplayStatusAfterConfirm(DisplayStatusInterface $displayStatusAfterConfirm): self
    {
        $this->displayStatusAfterConfirm = $displayStatusAfterConfirm;

        return $this;
    }

    private function setDisplayStatusAfterFn(DisplayStatusInterface $displayStatusAfterFn): self
    {
        $this->displayStatusAfterFn = $displayStatusAfterFn;

        return $this;
    }

    private function setConfirmButton(ConfirmButtonInterface $confirmButton): self
    {
        $this->confirmButton = $confirmButton;

        return $this;
    }

    private function setFnButton(FnButtonInterface $fnButton): self
    {
        $this->fnButton = $fnButton;

        return $this;
    }

    private function setQuantityKeys(QuantityKeysInterface $quantityKeys): self
    {
        $this->quantityKeys = $quantityKeys;

        return $this;
    }
}
