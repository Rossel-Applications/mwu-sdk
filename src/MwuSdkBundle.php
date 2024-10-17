<?php

declare(strict_types=1);

namespace MwuSdk;

use MwuSdk\DependencyInjection\Compiler\AddEventListenerTagPass;
use MwuSdk\DependencyInjection\MwuSdkExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class MwuSdkBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->registerExtension(new MwuSdkExtension());
        $container->addCompilerPass(new AddEventListenerTagPass());
    }
}
