<?php

declare(strict_types=1);

namespace MwuSdk\DependencyInjection\Compiler;

use MwuSdk\Events\Listener\EventListenerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class AddEventListenerTagPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $definition) {
            dump($definition);
            if ($this->implementsEventListenerInterface($definition)) {
                $definition->addTag('mwu_sdk.event_listener');
            }
        }
    }

    private function implementsEventListenerInterface(Definition $definition): bool
    {
        $class = $definition->getClass();

        if (!$class) {
            return false;
        }

        return is_subclass_of($class, EventListenerInterface::class);
    }
}
