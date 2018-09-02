<?php

use App\Service\HelloService;

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /** @var \Psr\Container\ContainerInterface $serviceContainer */
        $serviceContainer = $this->getInvokeArg('serviceContainer');
        /** @var HelloService $helloService */
        $helloService = $serviceContainer->get(HelloService::class);
        $this->view->helloMessage = $helloService->hello();
    }
}

