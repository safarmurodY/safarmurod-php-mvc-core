<?php

namespace Safarmurod\PhpMvcCore\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You DO NOT HAVE PERMISSION';
    protected $code = 403;
}