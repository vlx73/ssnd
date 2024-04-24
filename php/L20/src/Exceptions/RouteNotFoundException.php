<?php

namespace l20\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Route not found';
}