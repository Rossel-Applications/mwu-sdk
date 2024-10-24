<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use Rossel\MwuSdk\Serializer\DenormalizerInterface;

/**
 *  This interface is aimed to be implemented by classes responsible for denormalizing an array of switches configuration data
 *  into an array of SwitchConfig objects. It validates the input data and constructs
 *  the configuration objects based on the provided parameters.
 */
interface SwitchesConfigDenormalizerInterface extends DenormalizerInterface
{
    /**
     * Denormalizes the given data into an array of SwitchConfigInterface instances.
     *
     * @param array<array-key, array<array-key, mixed>> $data the configuration data for switches
     *
     * @return list<SwitchConfigInterface> an array of denormalized SwitchConfigInterface instances
     */
    public function denormalize(array $data): array;

    /**
     * Denormalizes an individual switch configuration item into a SwitchConfigInterface instance.
     *
     * @param array<array-key, mixed> $itemConfig the configuration data for a single switch
     *
     * @return SwitchConfigInterface the denormalized SwitchConfigInterface instance
     */
    public function denormalizeItem(array $itemConfig): SwitchConfigInterface;
}
