<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Model;

/**
 * Interface intended to be implemented by classes representing confirm button of a light module.
 */
interface ConfirmButtonInterface
{
    /**
     * Checks if the button is enabled.
     *
     * @return bool true if the button is enabled, false otherwise
     */
    public function isEnabled(): bool;

    /**
     * Sets the enabled state of the button.
     *
     * @param bool $enabled the new state to set
     *
     * @return self returns the instance for method chaining
     */
    public function setEnabled(bool $enabled): self;
}
