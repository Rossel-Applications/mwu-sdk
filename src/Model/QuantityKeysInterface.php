<?php

declare(strict_types=1);

namespace MwuSdk\Model;

use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;

/**
 * Interface intended to be implemented by classes representing quantity keys of the light module.
 */
interface QuantityKeysInterface
{
    /**
     * Checks if the quantity keys are enabled.
     *
     * @return bool true if the quantity keys are enabled, false otherwise
     */
    public function isEnabled(): bool;

    /**
     * Sets the enabled state of the quantity keys.
     *
     * @param bool $enabled the new enabled state
     *
     * @return self returns the instance for method chaining
     */
    public function setEnabled(bool $enabled): self;

    /**
     * Gets the mode of the quantity keys.
     *
     * @return QuantityKeysMode the mode of the quantity keys
     */
    public function getMode(): QuantityKeysMode;

    /**
     * Sets the mode for the quantity keys.
     *
     * @param QuantityKeysMode $mode the new mode to be set
     *
     * @return self returns the instance for method chaining
     */
    public function setMode(QuantityKeysMode $mode): self;
}
