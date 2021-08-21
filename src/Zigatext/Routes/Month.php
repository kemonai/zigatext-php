<?php

namespace Kemonai\Zigatext\Routes;

use Kemonai\Zigatext\Contracts\RouteInterface;

class Month implements RouteInterface
{

    public static function root()
    {
        return '/months';
    }

    public static function getList()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Month::root(),
        ];
    }
}
