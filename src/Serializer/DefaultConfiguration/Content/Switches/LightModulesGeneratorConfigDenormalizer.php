<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Switches;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfig;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\LightModulesGeneratorConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Switches\LightModulesGeneratorConfigValidator;

/**
 * Class LightModulesGeneratorConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of light modules generator
 * configuration data into a LightModulesGeneratorConfig object. It validates the input
 * data and constructs the configuration object based on the provided parameters.
 */
final readonly class LightModulesGeneratorConfigDenormalizer implements LightModulesGeneratorConfigDenormalizerInterface
{
    public function __construct(
        private LightModulesGeneratorConfigValidator $lightModulesGeneratorConfigValidator,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): LightModulesGeneratorConfig
    {
        $this->lightModulesGeneratorConfigValidator->validate($data);

        /** @var ?int $incrementBetweenModuleIds */
        $incrementBetweenModuleIds = $data[LightModulesGeneratorConfigKeysEnum::KEY_INCREMENT_BETWEEN_MODULE_IDS->value] ?? null;

        /** @var int $firstModuleId */
        $firstModuleId = $data[LightModulesGeneratorConfigKeysEnum::KEY_FIRST_MODULE_ID->value];
        /** @var int $numberOfModules */
        $numberOfModules = $data[LightModulesGeneratorConfigKeysEnum::KEY_NUMBER_OF_MODULES->value];

        if (null === $incrementBetweenModuleIds) {
            return new LightModulesGeneratorConfig($firstModuleId, $numberOfModules);
        }

        return new LightModulesGeneratorConfig($firstModuleId, $numberOfModules, $incrementBetweenModuleIds);
    }
}
