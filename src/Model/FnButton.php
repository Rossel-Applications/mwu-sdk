<?php

declare(strict_types=1);

namespace MwuSdk\Model;

/**
 * Class representing the fn button of a light module.
 */
final class FnButton implements FnButtonInterface
{
    private bool $enabled = false;
    private string $text = '';
    private bool $useAsDecrement = false;

    public function __construct(
        ?bool $enabled = null,
        ?string $text = null,
        ?bool $useAsDecrement = null,
    ) {
        if (null !== $enabled) {
            $this->enabled = $enabled;
        }

        if (null !== $text) {
            $this->text = $text;
        }

        if (null !== $useAsDecrement) {
            $this->useAsDecrement = $useAsDecrement;
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

    /**
     * {@inheritDoc}
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * {@inheritDoc}
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isUseAsDecrement(): bool
    {
        return $this->useAsDecrement;
    }

    /**
     * {@inheritDoc}
     */
    public function setUseAsDecrement(bool $useAsDecrement): self
    {
        $this->useAsDecrement = $useAsDecrement;

        return $this;
    }
}
