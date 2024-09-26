<?php

declare(strict_types=1);

namespace MwuSdk\Model;

/**
 * Interface intended to be implemented by classes representing fn button of a light module.
 */
interface FnButtonInterface
{
    /**
     * Checks if the function button is enabled.
     *
     * @return bool true if the button is enabled, false otherwise
     */
    public function isEnabled(): bool;

    /**
     * Sets the enabled state of the function button.
     *
     * @param bool $enabled the new enabled state
     *
     * @return self returns the instance for method chaining
     */
    public function setEnabled(bool $enabled): self;

    /**
     * Gets the text associated with the function button.
     *
     * @return string the text of the button
     */
    public function getText(): string;

    /**
     * Sets the text for the function button.
     *
     * @param string $text the text to be set for the button
     *
     * @return self returns the instance for method chaining
     */
    public function setText(string $text): self;

    /**
     * Checks if the function button is used as a decrement button.
     *
     * @return bool true if the button is used as decrement, false otherwise
     */
    public function isUseAsDecrement(): bool;

    /**
     * Sets the state of whether the function button is used as a decrement button.
     *
     * @param bool $useAsDecrement the new state for decrement usage
     *
     * @return self returns the instance for method chaining
     */
    public function setUseAsDecrement(bool $useAsDecrement): self;
}
