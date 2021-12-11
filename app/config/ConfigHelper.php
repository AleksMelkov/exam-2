<?php
namespace App\Config;

class ConfigHelper
{
    public static function getConfig($pathStr) {
        include('settings.php');
        $path = explode('.', $pathStr);
        $name = $path[0];
        $field = $path[1];
        return $$name[$field];
    }
}
