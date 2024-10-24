<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Model;

/**
 * Interface intended to be implemented by classes representing fn button of a light module.
 */
interface FnButtonInterface
{
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
}
