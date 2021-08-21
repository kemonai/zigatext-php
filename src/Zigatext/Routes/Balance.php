<?php

namespace Kemonai\Zigatext\Routes;

use Kemonai\Zigatext\Contracts\RouteInterface;

class Balance implements RouteInterface
{

    public static function root()
    {
        return '/check-balance';
    }

    public static function check()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Balance::root(),
        ];
    }
}
