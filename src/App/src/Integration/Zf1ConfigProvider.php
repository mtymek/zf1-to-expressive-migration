<?php

declare(strict_types=1);

namespace App\Integration;

use Zend_Config_Ini;

class Zf1ConfigProvider
{
    /** @var string */
    private $iniConfigFile;

    /** @var string */
    private $environment;

    public function __construct(string $iniConfigFile, ?string $environment = null)
    {
        $this->iniConfigFile = $iniConfigFile;
        if (null === $environment) {
            $environment = 'production';
        }
        $this->environment = $environment;
    }

    public function __invoke(): array
    {
        $config = new Zend_Config_Ini($this->iniConfigFile, $this->environment);
        return ['zf1_config' => $config->toArray()];
    }
}
