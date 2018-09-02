<?php

declare(strict_types=1);

namespace App\Integration;

use Psr\Container\ContainerInterface;
use Zend_Application;

class Zf1MiddlewareFactory
{
    public function __invoke(ContainerInterface $container): Zf1Middleware
    {
        return new Zf1Middleware(
            $container->get(Zend_Application::class)
        );
    }
}
