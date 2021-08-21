<?php

namespace Kemonai\Zigatext\Helpers;

use \Kemonai\Zigatext\Exception\ValidationException;

class Router
{
    private $route;
    private $route_class;
    private $methods;
    public static $ROUTES = [
        'balance', 'birthday', 'message', 'month', 'newsletter', 'timezone'
    ];
    public static $ROUTE_SINGULAR_LOOKUP = [
        'balances'=>'balance',
        'birthdays'=>'birthday',
        'messages'=>'message',
        'months'=>'month',
        'newsletters'=>'newsletter',
        'timezones'=>'timezone',
    ];

    const ID_KEY = 'id';
    const ZIGATEXT_API_ROOT = 'https://api.zigatext.com/v1/third-party';

    public function __call($methd, $sentargs)
    {
        $method = ($methd === 'list' ? 'getList' : $methd );
        if (array_key_exists($method, $this->methods) && is_callable($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $sentargs);
        } else {
            throw new \Exception('Function "' . $method . '" does not exist for "' . $this->route . '".');
        }
        
    }

    public static function singularFor($method)
    {
        return (
            array_key_exists($method, Router::$ROUTE_SINGULAR_LOOKUP) ?
                Router::$ROUTE_SINGULAR_LOOKUP[$method] :
                null
            );
    }

    public function __construct($route, $zigatextObj)
    {
        if (!in_array($route, Router::$ROUTES)) {
            throw new ValidationException(
                "Route '{$route}' does not exist."
            );
        }

        $this->route = strtolower($route);
        $this->route_class = 'Kemonai\\Zigatext\\Routes\\' . ucwords($route);

        $mets = get_class_methods($this->route_class);
        if (empty($mets)) {
            throw new \InvalidArgumentException('Class "' . $this->route . '" does not exist.');
        }
        
        // add methods to this object per method, except root
        foreach ($mets as $mtd) {
            if ($mtd === 'root') {
                continue;
            }
            $mtdFunc = function (
                array $params = [ ],
                array $sentargs = [ ]
            ) use (
                $mtd,
                $zigatextObj
            ) {
                $interface = call_user_func($this->route_class . '::' . $mtd);
                // TODO: validate params and sentargs against definitions
                $caller = new Caller($zigatextObj);
                return $caller->callEndpoint($interface, $params, $sentargs);
            };
            $this->methods[$mtd] = \Closure::bind($mtdFunc, $this, get_class());
        }
    }
}
