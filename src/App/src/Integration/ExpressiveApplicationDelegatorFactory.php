<?php

declare(strict_types=1);

namespace App\Integration;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

class ExpressiveApplicationDelegatorFactory implements DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null): Application
    {
        $zf1Config = $container->get('config')['zf1_config'];
        if (isset($zf1Config['phpSettings'])) {
            PhpSettingsManager::setPhpSettings($zf1Config['phpSettings']);
        }
        return $callback();
    }
}
