<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Model\ConfirmButtonInterface;
use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeysInterface;

/**
 * Interface for MWU Light Modules.
 */
interface MwuLightModuleInterface
{
    /** Gets the ID of the Light Module. */
    public function getId(): ?int;

    /** Gets the default display status. */
    public function getDisplayStatus(): DisplayStatusInterface;

    /** Gets the display status after the "Fn" button is pressed. */
    public function getDisplayStatusAfterFn(): DisplayStatusInterface;

    /** Gets the display status after the "Confirm" button is pressed. */
    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface;

    /** Gets the "Confirm" button. */
    public function getConfirmButton(): ConfirmButtonInterface;

    /** Gets the "Fn" button. */
    public function getFnButton(): FnButtonInterface;

    /** Gets the 3 quantity keys. */
    public function getQuantityKeys(): QuantityKeysInterface;

    /** Gets the connected switch, if any. */
    public function getSwitch(): ?MwuSwitchInterface;

    /**
     * Connects the Light Module to a switch.
     *
     * @param MwuSwitchInterface $switch the switch to connect to
     * @param int                $id     the ID to assign to the Light Module
     */
    public function connectSwitch(MwuSwitchInterface $switch, int $id): self;

    /**
     * Disconnects the Light Module from the switch.
     */
    public function disconnectSwitch(): self;
}
