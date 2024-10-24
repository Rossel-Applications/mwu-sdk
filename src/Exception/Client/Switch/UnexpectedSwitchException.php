<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Client\Switch;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;

/**
 * Exception thrown when the provided switch does not match the expected switch.
 */
final class UnexpectedSwitchException extends \RuntimeException implements SwitchClientExceptionInterface
{
    public function __construct(
        private readonly MwuSwitchInterface $provided,
        private readonly MwuSwitchInterface $expected,
        ?\Throwable $previous = null
    ) {
        parent::__construct(
            sprintf(
                'Unexpected switch encountered. Expected switch ID: %s, but received switch ID: %s.',
                $this->expected,
                $this->provided,
            ),
            0,
            $previous
        );
    }

    public function getProvided(): MwuSwitchInterface
    {
        return $this->provided;
    }

    public function getExpected(): MwuSwitchInterface
    {
        return $this->expected;
    }
}
