<?php

namespace Onjiro\Bundle\MemcacheProxyBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/sample/generated_class")
     * @Template()
     */
    public function indexAction()
    {
        return new JsonResponse();
    }
}
