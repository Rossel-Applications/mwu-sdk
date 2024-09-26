<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\MwuSwitch;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

final readonly class MwuSwitchFactory implements MwuSwitchFactoryInterface
{
    public function __construct(
        private MwuLightModuleFactory $lightModuleFactory
    ) {
    }

    public function create(SwitchConfigInterface $config): MwuSwitch
    {
        $switch = new MwuSwitch($config);

        $this->lightModuleFactory->generateCollection(
            $config->getLightModulesGeneratorConfig(),
            $switch,
        );

        return $switch;
    }

    /**
     * @param array<array-key, SwitchConfigInterface> $configs
     *
     * @return list<MwuSwitch>
     */
    public function createCollection(array $configs): array
    {
        return array_map(
            [$this, 'create'],
            $configs,
        );
    }
}
