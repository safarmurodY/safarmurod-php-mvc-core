<?php

namespace app\core\exception;

class NotFoundException extends \Exception
{
    protected $message = 'Page not FOUND';
    protected $code = 404;
}