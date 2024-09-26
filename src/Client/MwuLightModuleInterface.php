<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Model\ConfirmButtonInterface;
use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeysInterface;

/**
 * Interface implemented by MWU Light Modules.
 */
interface MwuLightModuleInterface
{
    /** Returns the ID used to identify the Light Module from the Switch side, and communicate with it. */
    public function getId(): ?int;

    /** Returns the display status applied by default. */
    public function getDisplayStatus(): DisplayStatusInterface;

    /** Returns the display status applied after pressing the "Fn" button. */
    public function getDisplayStatusAfterFn(): DisplayStatusInterface;

    /** Returns the display status applied after pressing the "Confirm" button. */
    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface;

    /** Returns an object representing the "Confirm" button. */
    public function getConfirmButton(): ConfirmButtonInterface;

    /** Returns an object representing the "Fn" button. */
    public function getFnButton(): FnButtonInterface;

    /** Returns an object representing the 3 quantity keys. */
    public function getQuantityKeys(): QuantityKeysInterface;

    /** Returns the eventually connected Switch. */
    public function getSwitch(): ?MwuSwitchInterface;

    /**
     * Connect the Light Module to a switch by specifying the switch and requesting an id.
     *
     * @param MwuSwitchInterface $switch the switch to connect to
     * @param int                $id     the requested ID for the Light Module
     */
    public function connectSwitch(MwuSwitchInterface $switch, int $id): self;

    /**
     * Disconnect the Light Module from the attached switch.
     */
    public function disconnectSwitch(): self;
}
