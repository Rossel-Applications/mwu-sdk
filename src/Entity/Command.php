<?php

declare(strict_types=1);

namespace MwuSdk\Entity;

final class Command implements CommandInterface
{
    private string $command = '';

    public function length(): int
    {
        return \strlen($this->command);
    }

    public function __toString(): string
    {
        return '';
    }
}
