<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
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
     * Gets the maximum length of texts displayed on the screen.
     */
    public function getTextMaxLength(): int;

    /**
     * Sets the maximum length of texts displayed on the screen.
     */
    public function setTextMaxLength(int $textMaxLength): self;

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

    /**
     * Checks if the Light Module is reachable (i.e. is connected to a switch and has an ID).
     */
    public function checkIfReachable(bool $throwErrors = false): bool;

    /**
     * Sends a write command to the Light Module.
     *
     * @param WriteCommandBuilderInterface $commandBuilder the builder used to create the write command
     * @param string                       $text           the text to be written to the Light Module (optional)
     *
     * @return string|null the response from the Light Module, or null if the command could not be sent
     */
    public function write(
        WriteCommandBuilderInterface $commandBuilder,
        string $text = '',
    ): ?string;
}
