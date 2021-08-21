<?php

namespace Kemonai\Zigatext\Http;

use \Kemonai\Zigatext\Contracts\RouteInterface;
use \Kemonai\Zigatext\Helpers\Router;
use \Kemonai\Zigatext;

class RequestBuilder
{
    protected $zigatextObj;
    protected $interface;
    protected $request;

    public $payload = [ ];
    public $sentargs = [ ];

    public function __construct(Zigatext $zigatextObj, $interface, array $payload = [ ], array $sentargs = [ ])
    {
        $this->request = new Request($zigatextObj);
        $this->zigatextObj = $zigatextObj;
        $this->interface = $interface;
        $this->payload = $payload;
        $this->sentargs = $sentargs;
    }

    public function build()
    {
        $this->request->headers["Access-Key"] = $this->zigatextObj->access_key;
        $this->request->headers["User-Agent"] = "Zigatext/v1 PhpBindings/" . Zigatext::VERSION;
        $this->request->endpoint = Router::ZIGATEXT_API_ROOT . $this->interface[RouteInterface::ENDPOINT_KEY];
        $this->request->method = $this->interface[RouteInterface::METHOD_KEY];
        $this->moveArgsToSentargs();
        $this->putArgsIntoEndpoint($this->request->endpoint);
        $this->packagePayload();
        return $this->request;
    }

    public function packagePayload()
    {
        if (is_array($this->payload) && count($this->payload)) {
            if ($this->request->method === RouteInterface::GET_METHOD) {
                $this->request->endpoint = $this->request->endpoint . '?' . http_build_query($this->payload);
            } else {
                $this->request->body = json_encode($this->payload);
            }
        }
    }

    public function putArgsIntoEndpoint(&$endpoint)
    {
        foreach ($this->sentargs as $key => $value) {
            $endpoint = str_replace('{' . $key . '}', $value, $endpoint);
        }
    }

    public function moveArgsToSentargs()
    {
        if (!array_key_exists(RouteInterface::ARGS_KEY, $this->interface)) {
            return;
        }
        $args = $this->interface[RouteInterface::ARGS_KEY];
        foreach ($this->payload as $key => $value) {
            if (in_array($key, $args)) {
                $this->sentargs[$key] = $value;
                unset($this->payload[$key]);
            }
        }
    }
}
