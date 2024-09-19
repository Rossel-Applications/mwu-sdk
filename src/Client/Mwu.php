<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Client\Interface\MwuClientInterface;

/**
 * This class serves as the main entry point for managing and interacting with MWU light modules and switches.
 * It may provide utility functions, configuration settings, and methods for initiating communication
 * with individual screens or groups of screens.
 */
final class Mwu implements MwuClientInterface
{
    /**
     * @var array<array-key, MwuSwitch>
     */
    private array $switches = [];

    /**
     * @return array<array-key, MwuSwitch>
     */
    public function getSwitches(): array
    {
        return $this->switches;
    }
}
