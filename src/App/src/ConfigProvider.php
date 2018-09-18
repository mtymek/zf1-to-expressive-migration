<?php

declare(strict_types=1);

namespace App;

use App\Integration\ExpressiveApplicationDelegatorFactory;
use App\Integration\Zf1ApplicationFactory;
use App\Integration\Zf1Middleware;
use App\Integration\Zf1MiddlewareFactory;
use Zend\Expressive\Application;
use Zend_Application;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Zf1Middleware::class => Zf1MiddlewareFactory::class,
                Zend_Application::class => Zf1ApplicationFactory::class,
            ],
            'delegators' => [
                Application::class => [
                    ExpressiveApplicationDelegatorFactory::class
                ],
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
