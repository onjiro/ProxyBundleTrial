<?php

namespace Onjiro\Bundle\MemcacheProxyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\ParameterGenerator;
use Zend\Code\Generator\FileGenerator;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OnjiroMemcacheProxyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // generate class
        $method = new MethodGenerator(
            $name = 'method',
            $parameters = [
                new ParameterGenerator('parameters', 'array', [])
            ],
            $flags = MethodGenerator::FLAG_PUBLIC,
            $body = "echo 'Generated method called!!';",
            null
        );

        $class = new ClassGenerator();
        $class->setName('GenerateExample');
        $class->addMethods([
            $method,
        ]);
        $file = new FileGenerator();
        $file->setClass($class);
        $file->setNameSpace("Proxy");
        $code = $file->generate();

        // output to cache folder
        $filepath = $container->getParameter('kernel.cache_dir').'/Proxy/GenerateExample.php';
        $fileDir = dirname($filepath);
        if (file_exists($fileDir) && !is_dir($fileDir)) {
            throw new \Exception("Fail to make directory '${fileDir}'");
        } else if (!file_exists($fileDir)) {
            mkdir($fileDir, 0777, true);
        }
        file_put_contents($filepath, $code);
    }
}
