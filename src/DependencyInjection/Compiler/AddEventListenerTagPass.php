<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\DependencyInjection\Compiler;

use Rossel\MwuSdk\Events\Listener\EventListenerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class AddEventListenerTagPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $definition) {
            if ($definition->getClass()
                && is_subclass_of($definition->getClass(), EventListenerInterface::class)
            ) {
                $definition->addTag('mwu_sdk.event_listener');
            }
        }
    }
}
