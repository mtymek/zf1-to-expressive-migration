<?php

namespace App\Integration;

class PhpSettingsManager
{
    public static function setPhpSettings(array $settings, $prefix = '')
    {
        foreach ($settings as $key => $value) {
            $key = empty($prefix) ? $key : $prefix . $key;
            if (is_scalar($value)) {
                ini_set($key, $value);
            } elseif (is_array($value)) {
                static::setPhpSettings($value, $key . '.');
            }
        }
    }
}
