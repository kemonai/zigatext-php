<?php

namespace Kemonai\Zigatext\Routes;

use Kemonai\Zigatext\Contracts\RouteInterface;

class Birthday implements RouteInterface
{

    public static function root()
    {
        return '/birthdays';
    }

    public static function addContactToGroup()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::POST_METHOD,
            RouteInterface::ENDPOINT_KEY => Birthday::root() . '/{group_id}/contacts',
            RouteInterface::PARAMS_KEY => [
                'name',
                'phone_no',
                'day',
                'month_id',
            ],
            RouteInterface::ARGS_KEY => ['group_id'],
        ];
    }

    public static function addBulkContactsToGroup()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::POST_METHOD,
            RouteInterface::ENDPOINT_KEY => Birthday::root() . '/{group_id}/contacts/bulk',
            RouteInterface::PARAMS_KEY => [
                'contacts' => [
                    'name',
                    'phone_no',
                    'day',
                    'month_id',
                ],
            ],
            RouteInterface::ARGS_KEY => ['group_id'],
        ];
    }

    public static function getGroupList()
    {
        return [
            RouteInterface::METHOD_KEY => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Birthday::root() . '/groups',
        ];
    }
}
