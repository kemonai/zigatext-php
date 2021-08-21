<?php

namespace Kemonai;

use \Kemonai\Zigatext\Helpers\Router;

class Zigatext
{
    public $access_key;
    public $use_guzzle = false;
    public static $fallback_to_file_get_contents = true;
    const VERSION="1.0.0";

    public function __construct($access_key)
    {
        if (!is_string($access_key) || !(substr($access_key, 0, 7)==='ZIGACK-')) {
            throw new \InvalidArgumentException('A Valid Zigatext Access Key must start with \'ZIGACK-\'.');
        }
        if (!is_string($access_key) || !(substr($access_key, strlen($access_key)-3)==='-KT')) {
            throw new \InvalidArgumentException('A Valid Zigatext Access Key must end with \'-KT\'.');
        }
        $this->access_key = $access_key;
    }

    public function useGuzzle()
    {
        $this->use_guzzle = true;
    }

    public static function disableFileGetContentsFallback()
    {
        Zigatext::$fallback_to_file_get_contents = false;
    }

    public static function enableFileGetContentsFallback()
    {
        Zigatext::$fallback_to_file_get_contents = true;
    }

    public function __call($method, $args)
    {
        if ($singular_form = Router::singularFor($method)) {
            return $this->handlePlural($singular_form, $method, $args);
        }
        return $this->handleSingular($method, $args);
    }

    private function handlePlural($singular_form, $method, $args)
    {
        if ((count($args) === 1 && is_array($args[0]))||(count($args) === 0)) {
            return $this->{$singular_form}->__call('getList', $args);
        }
        throw new \InvalidArgumentException(
            'Route "' . $method . '" can only accept an optional array of filters and '
            .'paging arguments (perPage, page).'
        );
    }

    private function handleSingular($method, $args)
    {
        if (count($args) === 1) {
            $args = [[], [ Router::ID_KEY => $args[0] ] ];
            return $this->{$method}->__call('fetch', $args);
        }
        throw new \InvalidArgumentException(
            'Route "' . $method . '" can only accept an id or code.'
        );
    }

    public function __get($name)
    {
        return new Router($name, $this);
    }
}
