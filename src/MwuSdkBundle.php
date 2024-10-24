<?php

declare(strict_types=1);

namespace Rossel\MwuSdk;

use Rossel\MwuSdk\DependencyInjection\Compiler\AddEventListenerTagPass;
use Rossel\MwuSdk\DependencyInjection\MwuSdkExtension;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\BehaviorConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\QuantityKeysConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\DisplayConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\LightConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\ScreenConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\ConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\LightModulesGeneratorConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class MwuSdkBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        /* @phpstan-ignore method.notFound */
        $definition->rootNode()
            ->children()
                ->arrayNode(ConfigKeysEnum::KEY_SWITCHES->value)
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode(SwitchesConfigKeysEnum::ITEM_KEY_IP_ADDRESS->value)->isRequired()->end()
                            ->integerNode(SwitchesConfigKeysEnum::ITEM_KEY_IP_PORT->value)->isRequired()->end()
                            ->arrayNode(SwitchesConfigKeysEnum::ITEM_KEY_LIGHT_MODULES_GENERATOR->value)
                                ->children()
                                    ->integerNode(LightModulesGeneratorConfigKeysEnum::KEY_FIRST_MODULE_ID->value)->isRequired()->end()
                                    ->integerNode(LightModulesGeneratorConfigKeysEnum::KEY_INCREMENT_BETWEEN_MODULE_IDS->value)->isRequired()->end()
                                    ->integerNode(LightModulesGeneratorConfigKeysEnum::KEY_NUMBER_OF_MODULES->value)->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode(ConfigKeysEnum::KEY_BEHAVIOR->value)
                    ->children()
                        ->arrayNode(BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS->value)
                            ->children()
                                ->arrayNode(DisplayConfigKeysEnum::KEY_LIGHT->value)
                                    ->children()
                                        ->enumNode(LightConfigKeysEnum::KEY_MODE->value)->values(LightMode::values())->isRequired()->end()
                                        ->enumNode(LightConfigKeysEnum::KEY_COLOR->value)->values(LightColor::values())->isRequired()->end()
                                    ->end()
                                ->end()
                                ->arrayNode(DisplayConfigKeysEnum::KEY_SCREEN->value)
                                    ->children()
                                        ->enumNode(ScreenConfigKeysEnum::KEY_MODE->value)->values(ScreenDisplayMode::values())->isRequired()->end()
                                        ->scalarNode(ScreenConfigKeysEnum::KEY_TEXT->value)->isRequired()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode(BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS_AFTER_CONFIRM->value)
                            ->children()
                                ->arrayNode(DisplayConfigKeysEnum::KEY_LIGHT->value)
                                    ->children()
                                        ->enumNode(LightConfigKeysEnum::KEY_MODE->value)->values(LightMode::values())->isRequired()->end()
                                        ->enumNode(LightConfigKeysEnum::KEY_COLOR->value)->values(LightColor::values())->isRequired()->end()
                                    ->end()
                                ->end()
                                ->arrayNode(DisplayConfigKeysEnum::KEY_SCREEN->value)
                                    ->children()
                                        ->enumNode(ScreenConfigKeysEnum::KEY_MODE->value)->values(ScreenDisplayMode::values())->isRequired()->end()
                                        ->scalarNode(ScreenConfigKeysEnum::KEY_TEXT->value)->isRequired()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode(BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS_AFTER_FN->value)
                            ->children()
                                ->arrayNode(DisplayConfigKeysEnum::KEY_LIGHT->value)
                                    ->children()
                                        ->enumNode(LightConfigKeysEnum::KEY_MODE->value)->values(LightMode::values())->isRequired()->end()
                                        ->enumNode(LightConfigKeysEnum::KEY_COLOR->value)->values(LightColor::values())->isRequired()->end()
                                    ->end()
                                ->end()
                                ->arrayNode(DisplayConfigKeysEnum::KEY_SCREEN->value)
                                    ->children()
                                        ->enumNode(ScreenConfigKeysEnum::KEY_MODE->value)->values(ScreenDisplayMode::values())->isRequired()->end()
                                        ->scalarNode(ScreenConfigKeysEnum::KEY_TEXT->value)->isRequired()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode(BehaviorConfigKeysEnum::KEY_BUTTONS->value)
                            ->children()
                                ->arrayNode(ButtonsConfigKeysEnum::KEY_FN->value)
                                    ->children()
                                        ->scalarNode(FnButtonConfigKeysEnum::KEY_TEXT->value)->isRequired()->end()
                                    ->end()
                                ->end()
                                ->arrayNode(ButtonsConfigKeysEnum::KEY_QUANTITY_KEYS->value)
                                    ->children()
                                    ->enumNode(QuantityKeysConfigKeysEnum::KEY_MODE->value)->values(QuantityKeysMode::values())->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->registerExtension(new MwuSdkExtension());
        $container->addCompilerPass(new AddEventListenerTagPass());
    }
}
