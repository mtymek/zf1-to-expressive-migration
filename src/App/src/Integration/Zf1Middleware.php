<?php

declare(strict_types=1);

namespace App\Integration;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend_Application;

class Zf1Middleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Default ZF1 bootstrap - copied from legacy skeleton's index.php
        defined('APPLICATION_PATH')
            || define('APPLICATION_PATH', realpath('application'));
        defined('APPLICATION_ENV')
            || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
        set_include_path(implode(PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/../vendor/zendframework/zendframework1/library'),
            get_include_path(),
        )));
        $application = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );

        // Run ZF1 application
        $application->bootstrap()
            ->run();

        // Exit in order to avoid conflicts with Zend Expressive
        exit;
    }
}
