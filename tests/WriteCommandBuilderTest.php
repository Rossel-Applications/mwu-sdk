<?php

declare(strict_types=1);

namespace MwuSdkTest;

use MwuSdk\Builder\Command\Write\WriteCommandBuilder;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use MwuSdk\Factory\Client\MwuLightModuleFactory;
use MwuSdk\Factory\Client\MwuSwitchFactory;
use MwuSdk\Factory\Dto\Command\Write\WriteCommandModeArrayFactory;
use MwuSdk\Factory\Entity\ClientMessageFactory;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\BehaviorConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ButtonsConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ConfirmButtonConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\FnButtonConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\QuantityKeysConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\DisplayConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\LightConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\ScreenConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\ConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Switches\LightModulesGeneratorConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Switches\SwitchesConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Formats\YamlConfigurationDeserializer;
use MwuSdk\Validator\Command\TargetedLightModuleCommandValidator;
use MwuSdk\Validator\Command\TargetedSwitchCommandValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\BehaviorConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ButtonsConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\FnButtonConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\DisplayConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\LightConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\ScreenConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Switches\LightModulesGeneratorConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Switches\SwitchesConfigValidator;
use MwuSdkTest\Utils\InfrastructureGenerator;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Random\RandomException;

class WriteCommandBuilderTest extends TestCase
{
    /**
     * @throws RandomException
     */
    protected function setUp(): void
    {
        // $this->mwuSwitch = InfrastructureGenerator::generateMwuSwitch();
    }

    /**
     * @throws RandomException
     * @throws Exception
     * @throws TcpIpClientExceptionInterface
     */
    public function testBuildCommand(): void
    {
        $mwu = new MwuService(
            new MwuSwitchFactory(
                new MwuLightModuleFactory(),
                new ClientMessageFactory(),
                new TargetedSwitchCommandValidator(),
                new TargetedLightModuleCommandValidator(new TargetedSwitchCommandValidator()),
            ),
            new YamlConfigurationDeserializer(
                new ConfigDenormalizer(
                    new ConfigValidator(),
                    new SwitchesConfigDenormalizer(
                        new SwitchesConfigValidator(),
                        new LightModulesGeneratorConfigDenormalizer(
                            new LightModulesGeneratorConfigValidator(),
                        ),
                    ),
                    new BehaviorConfigDenormalizer(
                        new BehaviorConfigValidator(),
                        new ButtonsConfigDenormalizer(
                            new ButtonsConfigValidator(),
                            new ConfirmButtonConfigDenormalizer(
                                new ConfirmButtonConfigValidator(),
                            ),
                            new FnButtonConfigDenormalizer(
                                new FnButtonConfigValidator()
                            ),
                            new QuantityKeysConfigDenormalizer(
                                new QuantityKeysConfigValidator(),
                            )
                        ),
                        new DisplayConfigDenormalizer(
                            new DisplayConfigValidator(),
                            new ScreenConfigDenormalizer(new ScreenConfigValidator()),
                            new LightConfigDenormalizer(new LightConfigValidator())
                        )
                    )
                )
            )
        );

        $mwu->configure();

        $builder = new WriteCommandBuilder(new WriteCommandModeArrayFactory());
        $builder->withLightColor(LightColor::CYAN);

        $mwu->broadcastWrite($builder, '9999');
        $mwu->getSwitchById(0)->getLightModuleById(1)->write($builder, '----');
    }
}
