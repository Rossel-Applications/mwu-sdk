<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

interface CommandInterface
{
    public function length(): int;

    public function __toString(): string;
}
