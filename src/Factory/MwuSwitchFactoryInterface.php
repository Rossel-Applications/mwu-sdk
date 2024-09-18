<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

interface MwuSwitchFactoryInterface
{
    public function create(SwitchConfigInterface $config): MwuSwitchInterface;

    /**
     * @param array<array-key, SwitchConfigInterface> $configs
     *
     * @return list<MwuSwitchInterface>
     */
    public function createCollection(array $configs): array;
}
