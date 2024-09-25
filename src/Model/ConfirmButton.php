<?php

declare(strict_types=1);

namespace MwuSdk\Model;

/**
 * Represents confirm button of a light module.
 */
final class ConfirmButton implements ConfirmButtonInterface
{
    private bool $enabled = false;

    /**
     * Constructor to initialize the Confirm Button.
     *
     * @param bool|null $enabled optional initial state for the button; defaults to false if not provided
     */
    public function __construct(
        ?bool $enabled = null,
    ) {
        if (null !== $enabled) {
            $this->enabled = $enabled;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
