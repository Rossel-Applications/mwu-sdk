<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Client\Switch;

class LightModuleNotFoundException extends \RuntimeException implements SwitchClientExceptionInterface
{
    public function __construct(int $id, ?\Throwable $previous = null)
    {
        parent::__construct("Light module with ID $id not found.", 0, $previous);
    }
}
