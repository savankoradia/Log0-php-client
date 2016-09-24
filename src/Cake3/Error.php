<?php

namespace Log0\Exceptioner\Cake3;

use Cake\Error\ErrorHandler;
use Log0\Exceptioner\Core\Handler;

class Error extends ErrorHandler
{
    public function _displayError($error, $debug)
    {
        Handler::handleError($error['code'], $error['description'], $error['file'], $error['line'], $shutdown = false);
    }
}