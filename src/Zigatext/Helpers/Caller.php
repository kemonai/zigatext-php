<?php
namespace Kemonai\Zigatext\Helpers;

use \Kemonai\Zigatext\Http\RequestBuilder;

class Caller
{
    private $zigatextObj;

    public function __construct($zigatextObj)
    {
        $this->zigatextObj = $zigatextObj;
    }

    public function callEndpoint($interface, $payload = [ ], $sentargs = [ ])
    {
        $builder = new RequestBuilder($this->zigatextObj, $interface, $payload, $sentargs);
        
        return $builder->build()->send()->wrapUp();
    }
}
