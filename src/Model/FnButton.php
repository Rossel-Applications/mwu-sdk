<?php

declare(strict_types=1);

namespace MwuSdk\Model;

/**
 * Class representing the fn button of a light module.
 */
final class FnButton implements FnButtonInterface
{
    private string $text = '';

    public function __construct(
        ?string $text = null,
    ) {
        if (null !== $text) {
            $this->text = $text;
        }
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
}
