<?php

namespace Log0\Exceptioner\Cake3;

use Cake\Error\ExceptionRenderer;
use Log0\Exceptioner\Core\Handler;
use App\Controller\AppController;

class Renderer extends ExceptionRenderer
{

    protected function _getController()
    {
        return new AppController();
    }

    public function render()
    {
        $error = $this->error;
        $exception = new \ErrorException($error->getMessage(), $error->getCode(), $error->getCode(), $error->getFile(), $error->getLine());
        Handler::handleException($exception);
        $this->_getController()->response->body($error->getMessage());
        return $this->_getController()->response;
    }
}