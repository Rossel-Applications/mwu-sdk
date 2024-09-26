<?php

declare(strict_types=1);

namespace MwuSdk\Model;

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

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function isUseAsDecrement(): bool
    {
        return $this->useAsDecrement;
    }

    public function setUseAsDecrement(bool $useAsDecrement): self
    {
        $this->useAsDecrement = $useAsDecrement;

        return $this;
    }
}
