<?php

namespace Log0\Exceptioner\Core;

class Handler {

    public static $clientVersion = "1.0.0";
    public static $client = "php0";
    private static $exceptionHandler;
    private static $errorHandler;
    private static $errorTypes = array(E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_NOTICE);

    public static function init() {
        self::$exceptionHandler = set_exception_handler(array('Log0\Exceptioner\Core\Handler', 'handleException'));
        register_shutdown_function(array('Log0\Exceptioner\Core\Handler', 'handleShutdown'));
    }

    public static function handleError($code, $message, $file, $line, $shutdown = false) {
        if (in_array($code, self::$errorTypes)) {
            self::handleException(new \ErrorException($message, $code, $code, $file, $line));
        }

        if (self::$errorHandler && !$shutdown) {
            call_user_func(self::$errorHandler, $code, $message, $file, $line);
        }
    }

    public static function handleException($exception) {

        $data = new Data();
        $compiledData = $data->compileData($exception);

        $sender = new Sender();
        $sender->send($compiledData);

        if (self::$exceptionHandler) {
            call_user_func(self::$exceptionHandler, $exception);
        }
    }

    public static function handleShutdown() {
        if ($error = error_get_last()) {
            self::handleError($error['type'], $error['message'], $error['file'], $error['line'], true);
        }
    }

}
