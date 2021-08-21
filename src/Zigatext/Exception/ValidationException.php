<?php

namespace Kemonai\Zigatext\Exception;

class BadMetaNameException extends ZigatextException
{
    public $errors;
    public function __construct($message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }
}
