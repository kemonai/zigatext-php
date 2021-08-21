<?php

namespace Kemonai\Zigatext\Routes;

use Kemonai\Zigatext\Contracts\RouteInterface;

class Newsletter implements RouteInterface
{

    public static function root()
    {
        return '/newsletters';
    }

    public static function addSubscriber()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::POST_METHOD,
            RouteInterface::ENDPOINT_KEY => Newsletter::root() . '/{id}/subscribers',
            RouteInterface::PARAMS_KEY => [
                'name',
                'phone_no',
            ],
            RouteInterface::ARGS_KEY => ['id'],
        ];
    }

    public static function addBulkSubscribers()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::POST_METHOD,
            RouteInterface::ENDPOINT_KEY => Newsletter::root() . '/{id}/subscribers/bulk',
            RouteInterface::PARAMS_KEY => [
                'subscribers' => [
                    'name',
                    'phone_no',
                ],
            ],
            RouteInterface::ARGS_KEY => ['id'],
        ];
    }

    public static function getList()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Newsletter::root(),
        ];
    }
}
