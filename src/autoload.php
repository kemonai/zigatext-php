<?php

/**
 * Zigatext Autoloader
 * For use when library is being used without composer
 */

$zigatext_autoloader = function ($class_name) {
    if (strpos($class_name, 'Kemonai\Zigatext')===0) {
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $file .= str_replace([ 'Kemonai\\', '\\' ], ['', DIRECTORY_SEPARATOR ], $class_name) . '.php';
        include_once $file;
    }
};

spl_autoload_register($zigatext_autoloader);

return $zigatext_autoloader;
