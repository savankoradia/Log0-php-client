<?php

namespace Log0\Exceptioner\Core;

class Data {

    private $_exception;

    public function compileData($exception) {
        $this->_exception = $exception;

        $data = array();
        $data['name'] = get_class($this->_exception);
        $data['message'] = $this->_exception->getMessage();
        $data['root'] = $this->getApplicationRoot();
        $data['requestUri'] = $this->getRequestUri();
        $data['location'] = $this->getLocation();
        $data['trace'] = $this->getTrace();

        return $data;
    }

    private function getApplicationRoot() {
        if (isset($_SERVER['DOCUMENT_ROOT'])) {
            return $_SERVER['DOCUMENT_ROOT'];
        } else {
            return dirname(__FILE__);
        }
    }

    private function getRequestUri() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';
        $host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
        $port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : '';
        $path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        if ($port == 80 || $port == 443) {
            $port = null;
        } else {
            $port = ":" . $port;
        }
        return $protocol . $host . $port . $path;
    }

    private function getLocation() {
        return $this->_exception->getLine() . ' in ' . $this->_exception->getFile();
    }

    private function getTrace() {
        return explode("\n", $this->_exception->getTraceAsString());
    }

}
