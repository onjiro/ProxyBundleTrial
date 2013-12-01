<?php

namespace Onjiro\Bundle\MemcacheProxyBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zend\Code\Generator\ClassGenerator;

class DefaultController extends Controller
{
    /**
     * @Route("/sample/generated_class")
     * @Template()
     */
    public function indexAction()
    {
        $class = new ClassGenerator();
        $class->setName('GenerateExample');
        $code = $class->generate();
        
        return new JsonResponse(["generated class" => $code]);
    }
}
