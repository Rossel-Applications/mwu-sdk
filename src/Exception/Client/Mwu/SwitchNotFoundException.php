<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Client\Mwu;

final class SwitchNotFoundException extends \RuntimeException implements MwuClientExceptionInterface
{
    public function __construct(mixed $id, ?\Throwable $previous = null)
    {
        $message = \is_scalar($id) ?
            sprintf('Switch with ID %s not found.', $id) :
            'Switch not found.';

        parent::__construct($message, 0, $previous);
    }
}
