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
    /** @var Zend_Application */
    private $zf1Application;

    public function __construct(Zend_Application $zf1Application)
    {
        $this->zf1Application = $zf1Application;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->zf1Application->bootstrap()
            ->run();

        // Exit in order to avoid conflicts with Zend Expressive
        exit;
    }
}
