<?php

namespace Onjiro\Bundle\MemcacheProxyBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\ParameterGenerator;

class DefaultController extends Controller
{
    /**
     * @Route("/sample/generated_class")
     * @Template()
     */
    public function indexAction()
    {
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
        $code = $class->generate();

        echo $code."\n\n";

        eval($code);
        $generatedClass = new \GenerateExample();
        echo $generatedClass->method()."\n\n";
        
        return new JsonResponse(["generated class" => $code]);
    }
}
