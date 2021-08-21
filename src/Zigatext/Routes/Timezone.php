<?php

namespace Kemonai\Zigatext\Routes;

use Kemonai\Zigatext\Contracts\RouteInterface;

class Timezone implements RouteInterface
{

    public static function root()
    {
        return '/time-zones';
    }

    public static function getList()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Timezone::root(),
        ];
    }
}
