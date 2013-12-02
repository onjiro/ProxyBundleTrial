<?php

namespace Onjiro\Bundle\MemcacheProxyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

class ProxyGeneratePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->register('memcache_proxy.example', 'Proxy\GenerateExample');
    }
}
