<?php

namespace Kemonai\Zigatext\Exception;

class BadMetaNameException extends ZigatetxException
{
    public $errors;
    public function __construct($message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }
}
