<?php

namespace Kemonai\Zigatext\Exception;

class ZigatextException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
