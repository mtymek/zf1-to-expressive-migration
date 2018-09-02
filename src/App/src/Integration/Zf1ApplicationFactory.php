<?php

declare(strict_types=1);

namespace App\Integration;

use Psr\Container\ContainerInterface;
use Zend_Application;
use Zend_Controller_Front;

class Zf1ApplicationFactory
{
    public function __invoke(ContainerInterface $container): Zend_Application
    {
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

        Zend_Controller_Front::getInstance()->setParam('serviceContainer', $container);

        return $application;
    }
}
