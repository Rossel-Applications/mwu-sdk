<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client\Mwu;

final class SwitchNotFoundException extends \RuntimeException implements MwuClientExceptionInterface
{
    public function __construct(int $id, ?\Throwable $previous = null)
    {
        parent::__construct("Switch with ID $id not found.", 0, $previous);
    }
}
