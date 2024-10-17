<?php

declare(strict_types=1);

namespace MwuSdk\DependencyInjection\Compiler;

use MwuSdk\Events\Listener\EventListenerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AddEventListenerTagPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $definition) {
            $class = $definition->getClass();

            // Ignorer les services sans classe ou appartenant à certains namespaces problématiques
            if (!$class || strpos($class, 'Symfony\Component\Form') === 0 || strpos($class, 'Doctrine') === 0) {
                continue;
            }

            // Vérifier si la classe implémente EventListenerInterface
            if (is_subclass_of($class, EventListenerInterface::class)) {
                $definition->addTag('mwu_sdk.event_listener');
            }
        }
    }
}
