<?php

namespace Onjiro\Bundle\MemcacheProxyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Onjiro\Bundle\MemcacheProxyBundle\DependencyInjection\Compiler\ProxyGeneratePass;

class OnjiroMemcacheProxyBundle extends Bundle
{
    public function boot()
    {
        // auto load setting
        $file = $this->container->getParameter('kernel.cache_dir').'/GenerateExample.php';
        spl_autoload_register(function($className) use($file) {
            if ($className === 'GenerateExample') {
                require $file;
            }
        });
    }
}
