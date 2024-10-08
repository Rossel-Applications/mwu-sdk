<?php

declare(strict_types=1);

namespace MwuSdk\DependencyInjection;

use MwuSdk\Client\TcpIpClient;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MwuSdkExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }

    private function loadTcpIpClient(ContainerBuilder $container): void
    {
        $tcpIpClientDefinition = new Definition(TcpIpClient::class);
        $tcpIpClientDefinition->setAutowired(true);

        $container->setDefinition(TcpIpClient::class, $tcpIpClientDefinition);
    }
}
